<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Cycle;
use App\Models\Payment;
use App\Models\Tontine;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Admin — Paiements
 * @authenticated
 *
 * Enregistrement et suivi des paiements par cycle.
 */
class PaymentController extends Controller
{
    /**
     * Liste des paiements d'un cycle
     *
     * Retourne tous les paiements enregistrés pour un cycle,
     * ainsi que les membres n'ayant pas encore payé (en retard).
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @urlParam cycle integer required ID du cycle. Example: 1
     *
     * @response {
     *   "cycle": { "id": 1, "numero_cycle": 1, "statut": "ouvert" },
     *   "paiements": [
     *     { "id": 1, "montant": "5000.00", "statut": "paye", "paid_at": "2026-01-10",
     *       "membre": { "id": 3, "first_name": "Alice", "last_name": "Dupont" } }
     *   ],
     *   "en_retard": [
     *     { "id": 5, "first_name": "Bob", "last_name": "Martin", "ordre_passage": 2 }
     *   ],
     *   "resume": { "total_membres": 4, "ont_paye": 1, "en_retard": 3 }
     * }
     */
    public function index(Tontine $tontine, Cycle $cycle): JsonResponse
    {
        if ($cycle->tontine_id !== $tontine->id) {
            return response()->json(['message' => 'Cycle introuvable pour cette tontine.'], 404);
        }

        $paiements = $cycle->payments()
            ->with('membre:id,first_name,last_name,phone,ordre_passage')
            ->orderBy('paid_at')
            ->get();

        $membresPaye = $paiements->pluck('user_id')->toArray();

        // Membres de la tontine qui n'ont pas encore payé ce cycle
        $enRetard = $tontine->membres()
            ->whereNotIn('users.id', $membresPaye)
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.phone', 'users.ordre_passage')
            ->orderBy('users.ordre_passage')
            ->get();

        return response()->json([
            'cycle'     => $cycle->only(['id', 'numero_cycle', 'statut', 'date_ouverture', 'date_fermeture']),
            'paiements' => $paiements,
            'en_retard' => $enRetard,
            'resume'    => [
                'total_membres' => $tontine->membres()->count(),
                'ont_paye'      => $paiements->count(),
                'en_retard'     => $enRetard->count(),
            ],
        ]);
    }

    /**
     * Enregistrer un paiement
     *
     * Enregistre le paiement d'un membre pour un cycle donné.
     * ❗ Un membre ne peut payer qu'une seule fois par cycle (doublon bloqué).
     * Le statut est automatiquement calculé selon la date de paiement.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @urlParam cycle integer required ID du cycle. Example: 1
     *
     * @bodyParam user_id integer required ID du membre. Example: 3
     * @bodyParam montant number required Montant payé. Example: 5000
     * @bodyParam paid_at string Date du paiement (YYYY-MM-DD, défaut: aujourd'hui). Example: 2026-01-10
     * @bodyParam note string Note optionnelle. Example: Paiement en espèces
     *
     * @response 201 {
     *   "id": 1, "montant": "5000.00", "statut": "paye", "paid_at": "2026-01-10",
     *   "membre": { "id": 3, "first_name": "Alice", "last_name": "Dupont" }
     * }
     * @response 422 scenario="Double paiement" {
     *   "message": "Ce membre a déjà payé pour ce cycle."
     * }
     */
    public function store(Request $request, Tontine $tontine, Cycle $cycle): JsonResponse
    {
        if ($cycle->tontine_id !== $tontine->id) {
            return response()->json(['message' => 'Cycle introuvable pour cette tontine.'], 404);
        }

        if ($cycle->estFerme()) {
            return response()->json(['message' => 'Ce cycle est fermé. Impossible d\'enregistrer un paiement.'], 422);
        }

        $data = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'montant' => 'required|numeric|min:0',
            'paid_at' => 'nullable|date',
            'note'    => 'nullable|string|max:500',
        ]);

        // Vérifier que le membre appartient à la tontine
        $membre = $tontine->membres()->where('users.id', $data['user_id'])->first();
        if (! $membre) {
            return response()->json(['message' => 'Ce membre n\'appartient pas à cette tontine.'], 422);
        }

        // ❗ Bloquer le double paiement
        $dejaPayé = Payment::where('cycle_id', $cycle->id)
            ->where('user_id', $data['user_id'])
            ->exists();

        if ($dejaPayé) {
            return response()->json(['message' => 'Ce membre a déjà payé pour ce cycle.'], 422);
        }

        $paidAt = $data['paid_at'] ?? now()->toDateString();

        // Calcul automatique du statut : en retard si paiement après date_fermeture prévue
        $statut = $this->calculerStatut($cycle, $paidAt);

        $payment = DB::transaction(function () use ($cycle, $data, $paidAt, $statut, $request, $tontine) {
            $p = Payment::create([
                'cycle_id'       => $cycle->id,
                'user_id'        => $data['user_id'],
                'montant'        => $data['montant'],
                'statut'         => $statut,
                'paid_at'        => $paidAt,
                'enregistre_par' => $request->user()->id,
                'note'           => $data['note'] ?? null,
            ]);

            AuditLog::journaliser('paiement.enregistre', $p, [
                'tontine_id'   => $tontine->id,
                'tontine_nom'  => $tontine->nom,
                'cycle_numero' => $cycle->numero_cycle,
                'user_id'      => $data['user_id'],
                'montant'      => $data['montant'],
                'statut'       => $statut,
            ]);

            return $p;
        });

        return response()->json(
            $payment->load('membre:id,first_name,last_name,phone,ordre_passage'),
            201
        );
    }

    /**
     * Statut de paiement d'un membre pour un cycle
     *
     * Vérifie si un membre a payé ou est en retard pour un cycle donné.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @urlParam cycle integer required ID du cycle. Example: 1
     * @urlParam user integer required ID du membre. Example: 3
     *
     * @response {
     *   "membre": { "id": 3, "first_name": "Alice", "last_name": "Dupont" },
     *   "statut": "paye",
     *   "paiement": { "id": 1, "montant": "5000.00", "paid_at": "2026-01-10" }
     * }
     */
    public function statutMembre(Tontine $tontine, Cycle $cycle, User $user): JsonResponse
    {
        if ($cycle->tontine_id !== $tontine->id) {
            return response()->json(['message' => 'Cycle introuvable pour cette tontine.'], 404);
        }

        $payment = Payment::where('cycle_id', $cycle->id)
            ->where('user_id', $user->id)
            ->first();

        return response()->json([
            'membre'    => $user->only(['id', 'first_name', 'last_name', 'phone', 'ordre_passage']),
            'statut'    => $payment ? $payment->statut : 'en_retard',
            'paiement'  => $payment,
        ]);
    }

    /**
     * Calcule le statut du paiement.
     * En retard si le cycle a une date de fermeture et que le paiement est après.
     */
    private function calculerStatut(Cycle $cycle, string $paidAt): string
    {
        if ($cycle->date_fermeture && $paidAt > $cycle->date_fermeture->toDateString()) {
            return 'en_retard';
        }

        return 'paye';
    }
}
