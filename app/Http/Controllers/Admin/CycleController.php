<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Cycle;
use App\Models\Tontine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group Admin — Cycles
 * @authenticated
 *
 * Gestion des cycles d'une tontine (ouverture, fermeture, bénéficiaire).
 */
class CycleController extends Controller
{
    /**
     * Liste des cycles d'une tontine
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     *
     * @response [{
     *   "id": 1, "numero_cycle": 1, "statut": "ferme",
     *   "date_ouverture": "2026-01-01", "date_fermeture": "2026-01-31",
     *   "beneficiaire": { "id": 3, "first_name": "Alice", "last_name": "Dupont" }
     * }]
     */
    public function index(Tontine $tontine): JsonResponse
    {
        $cycles = $tontine->cycles()
            ->with('beneficiaire:id,first_name,last_name,phone')
            ->orderBy('numero_cycle')
            ->get();

        return response()->json($cycles);
    }

    /**
     * Ouvrir un nouveau cycle
     *
     * Crée le prochain cycle pour la tontine. Le bénéficiaire est déterminé
     * automatiquement selon l'ordre_passage des membres.
     * Un seul cycle ouvert est autorisé par tontine à la fois.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @bodyParam date_ouverture string Date d'ouverture (YYYY-MM-DD, défaut: aujourd'hui). Example: 2026-02-01
     *
     * @response 201 {
     *   "id": 2, "numero_cycle": 2, "statut": "ouvert",
     *   "date_ouverture": "2026-02-01",
     *   "beneficiaire": { "id": 5, "first_name": "Bob", "last_name": "Martin" }
     * }
     */
    public function store(Request $request, Tontine $tontine): JsonResponse
    {
        // Vérifier qu'il n'y a pas déjà un cycle ouvert
        if ($tontine->cycleActif()) {
            return response()->json([
                'message' => 'Un cycle est déjà ouvert pour cette tontine. Fermez-le avant d\'en ouvrir un nouveau.',
            ], 422);
        }

        // Vérifier que la tontine a des membres
        if ($tontine->membres()->count() === 0) {
            return response()->json([
                'message' => 'La tontine ne contient aucun membre.',
            ], 422);
        }

        $request->validate([
            'date_ouverture' => 'nullable|date',
            'date_fermeture' => 'nullable|date|after_or_equal:date_ouverture',
        ]);

        $beneficiaire = $tontine->prochainBeneficiaire();

        if (! $beneficiaire) {
            return response()->json([
                'message' => 'Impossible de déterminer le bénéficiaire.',
            ], 422);
        }

        $cycle = DB::transaction(function () use ($tontine, $beneficiaire, $request) {
            $dateOuverture  = $request->date_ouverture ?? now()->toDateString();
            $dateFermeture  = $request->date_fermeture
                ?? $tontine->dateFermetureCycle(\Carbon\Carbon::parse($dateOuverture))->toDateString();

            $c = Cycle::create([
                'tontine_id'         => $tontine->id,
                'numero_cycle'       => $tontine->prochainNumeroCycle(),
                'beneficiaire_id'    => $beneficiaire->id,
                'ordre_beneficiaire' => $beneficiaire->ordre_passage,
                'statut'             => 'ouvert',
                'date_ouverture'     => $dateOuverture,
                'date_fermeture'     => $dateFermeture,
            ]);

            AuditLog::journaliser('cycle.ouvert', $c, [
                'tontine_id'      => $tontine->id,
                'tontine_nom'     => $tontine->nom,
                'numero_cycle'    => $c->numero_cycle,
                'beneficiaire_id' => $beneficiaire->id,
                'beneficiaire'    => $beneficiaire->full_name,
            ]);

            return $c;
        });

        return response()->json(
            $cycle->load('beneficiaire:id,first_name,last_name,phone'),
            201
        );
    }

    /**
     * Détail d'un cycle
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @urlParam cycle integer required ID du cycle. Example: 1
     *
     * @response {
     *   "id": 1, "numero_cycle": 1, "statut": "ouvert",
     *   "beneficiaire": { "id": 3, "first_name": "Alice" }
     * }
     */
    public function show(Tontine $tontine, Cycle $cycle): JsonResponse
    {
        if ($cycle->tontine_id !== $tontine->id) {
            return response()->json(['message' => 'Cycle introuvable pour cette tontine.'], 404);
        }

        return response()->json($cycle->load('beneficiaire:id,first_name,last_name,phone'));
    }

    /**
     * Fermer un cycle
     *
     * Ferme le cycle actif et prépare automatiquement le prochain bénéficiaire.
     * La fermeture déclenche le passage au cycle suivant (le prochain cycle
     * devra être ouvert manuellement via POST).
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @urlParam cycle integer required ID du cycle à fermer. Example: 1
     * @bodyParam date_fermeture string Date de fermeture (YYYY-MM-DD, défaut: aujourd'hui). Example: 2026-01-31
     *
     * @response {
     *   "cycle_ferme": { "id": 1, "numero_cycle": 1, "statut": "ferme", "date_fermeture": "2026-01-31" },
     *   "prochain_beneficiaire": { "id": 5, "first_name": "Bob", "last_name": "Martin", "ordre_passage": 2 },
     *   "message": "Cycle 1 fermé. Prochain bénéficiaire : Bob Martin (ordre 2)."
     * }
     */
    public function fermer(Request $request, Tontine $tontine, Cycle $cycle): JsonResponse
    {
        if ($cycle->tontine_id !== $tontine->id) {
            return response()->json(['message' => 'Cycle introuvable pour cette tontine.'], 404);
        }

        if ($cycle->estFerme()) {
            return response()->json(['message' => 'Ce cycle est déjà fermé.'], 422);
        }

        $request->validate([
            'date_fermeture' => 'nullable|date',
        ]);

        $cycle->update([
            'statut'          => 'ferme',
            'date_fermeture'  => $request->date_fermeture ?? now()->toDateString(),
        ]);

        AuditLog::journaliser('cycle.ferme', $cycle, [
            'tontine_id'    => $tontine->id,
            'tontine_nom'   => $tontine->nom,
            'numero_cycle'  => $cycle->numero_cycle,
            'date_fermeture'=> $cycle->date_fermeture,
        ]);

        // Déterminer le prochain bénéficiaire (pour info)
        $prochainBeneficiaire = $tontine->prochainBeneficiaire();

        return response()->json([
            'cycle_ferme'           => $cycle->fresh()->load('beneficiaire:id,first_name,last_name'),
            'prochain_beneficiaire' => $prochainBeneficiaire ? [
                'id'             => $prochainBeneficiaire->id,
                'first_name'     => $prochainBeneficiaire->first_name,
                'last_name'      => $prochainBeneficiaire->last_name,
                'ordre_passage'  => $prochainBeneficiaire->ordre_passage,
            ] : null,
            'message' => $prochainBeneficiaire
                ? "Cycle {$cycle->numero_cycle} fermé. Prochain bénéficiaire : {$prochainBeneficiaire->full_name} (ordre {$prochainBeneficiaire->ordre_passage})."
                : "Cycle {$cycle->numero_cycle} fermé. Tous les membres ont bénéficié — nouveau tour possible.",
        ]);
    }
}
