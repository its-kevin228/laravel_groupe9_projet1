<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Cycle;
use App\Models\Payment;
use App\Models\Tontine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Admin — Historique & Audit
 * @authenticated
 *
 * Journal complet des paiements, bénéficiaires passés et actions admin.
 */
class HistoriqueController extends Controller
{
    /**
     * Historique global des paiements
     *
     * Tous les paiements enregistrés, filtrables par tontine, statut, période.
     *
     * @queryParam tontine_id integer Filtrer par tontine. Example: 1
     * @queryParam statut string Filtrer par statut (paye|en_retard). Example: paye
     * @queryParam date_debut string Date de début (YYYY-MM-DD). Example: 2026-01-01
     * @queryParam date_fin string Date de fin (YYYY-MM-DD). Example: 2026-12-31
     * @queryParam per_page integer Résultats par page (défaut: 20). Example: 20
     *
     * @response {
     *   "data": [{
     *     "id": 1, "montant": "5000.00", "statut": "paye", "paid_at": "2026-01-10",
     *     "membre": { "id": 3, "nom_complet": "Alice Dupont" },
     *     "cycle": { "numero_cycle": 1, "tontine": "Tontine Solidarité" },
     *     "enregistre_par": { "nom_complet": "Admin Test" }
     *   }],
     *   "total": 42, "current_page": 1
     * }
     */
    public function paiements(Request $request): JsonResponse
    {
        $query = Payment::with([
            'membre:id,first_name,last_name,phone',
            'cycle:id,numero_cycle,tontine_id,date_ouverture,date_fermeture',
            'cycle.tontine:id,nom',
            'enregistrePar:id,first_name,last_name',
        ])->latest('paid_at');

        if ($request->filled('tontine_id')) {
            $query->whereHas('cycle', fn($q) => $q->where('tontine_id', $request->tontine_id));
        }

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        if ($request->filled('date_debut')) {
            $query->where('paid_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->where('paid_at', '<=', $request->date_fin);
        }

        $paiements = $query->paginate($request->integer('per_page', 20));

        // Enrichir avec nom_complet
        $paiements->getCollection()->transform(fn($p) => [
            'id'             => $p->id,
            'montant'        => $p->montant,
            'statut'         => $p->statut,
            'paid_at'        => $p->paid_at,
            'note'           => $p->note,
            'membre'         => [
                'id'          => $p->membre->id,
                'nom_complet' => $p->membre->full_name,
                'phone'       => $p->membre->phone,
            ],
            'cycle'          => [
                'id'           => $p->cycle->id,
                'numero_cycle' => $p->cycle->numero_cycle,
                'tontine'      => $p->cycle->tontine->nom,
            ],
            'enregistre_par' => $p->enregistrePar
                ? $p->enregistrePar->full_name
                : 'Système',
        ]);

        return response()->json($paiements);
    }

    /**
     * Bénéficiaires passés
     *
     * Liste tous les cycles fermés avec leur bénéficiaire, filtrables par tontine.
     *
     * @queryParam tontine_id integer Filtrer par tontine. Example: 1
     *
     * @response [{
     *   "tontine": "Tontine Solidarité",
     *   "cycle_numero": 1,
     *   "beneficiaire": "Alice Dupont",
     *   "ordre_passage": 1,
     *   "date_ouverture": "2026-01-01",
     *   "date_fermeture": "2026-01-31",
     *   "total_collecte": "40000.00",
     *   "taux_participation": "100.00"
     * }]
     */
    public function beneficiaires(Request $request): JsonResponse
    {
        $query = Cycle::where('statut', 'ferme')
            ->with([
                'tontine:id,nom,montant_cotisation',
                'beneficiaire:id,first_name,last_name',
            ])
            ->orderBy('tontine_id')
            ->orderBy('numero_cycle');

        if ($request->filled('tontine_id')) {
            $query->where('tontine_id', $request->tontine_id);
        }

        $cycles = $query->get()->map(function (Cycle $cycle) {
            $totalMembres   = $cycle->tontine->membres()->count();
            $totalCollecte  = $cycle->payments()->where('statut', 'paye')->sum('montant');
            $tauxParticipation = $totalMembres > 0
                ? round(($cycle->payments()->count() / $totalMembres) * 100, 2)
                : 0;

            return [
                'tontine'           => $cycle->tontine->nom,
                'cycle_id'          => $cycle->id,
                'cycle_numero'      => $cycle->numero_cycle,
                'beneficiaire'      => $cycle->beneficiaire?->full_name,
                'ordre_passage'     => $cycle->ordre_beneficiaire,
                'date_ouverture'    => $cycle->date_ouverture,
                'date_fermeture'    => $cycle->date_fermeture,
                'total_collecte'    => number_format($totalCollecte, 2, '.', ''),
                'taux_participation'=> $tauxParticipation,
            ];
        });

        return response()->json($cycles);
    }

    /**
     * Journal des actions admin
     *
     * Toutes les actions enregistrées dans le journal d'audit.
     *
     * @queryParam action string Filtrer par type d'action. Example: paiement.enregistre
     * @queryParam user_id integer Filtrer par admin. Example: 1
     * @queryParam date_debut string Date de début. Example: 2026-01-01
     * @queryParam date_fin string Date de fin. Example: 2026-12-31
     * @queryParam per_page integer Résultats par page (défaut: 30). Example: 30
     *
     * @response {
     *   "data": [{
     *     "id": 1,
     *     "action": "paiement.enregistre",
     *     "entite_type": "Payment",
     *     "entite_id": 5,
     *     "details": { "tontine_nom": "Tontine Solidarité", "montant": 5000 },
     *     "admin": "Admin Test",
     *     "ip_address": "127.0.0.1",
     *     "created_at": "2026-01-10T08:30:00"
     *   }]
     * }
     */
    public function journal(Request $request): JsonResponse
    {
        $query = AuditLog::with('admin:id,first_name,last_name')
            ->latest();

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $logs = $query->paginate($request->integer('per_page', 30));

        $logs->getCollection()->transform(fn($log) => [
            'id'          => $log->id,
            'action'      => $log->action,
            'entite_type' => $log->entite_type,
            'entite_id'   => $log->entite_id,
            'details'     => $log->details,
            'admin'       => $log->admin?->full_name ?? 'Système',
            'ip_address'  => $log->ip_address,
            'created_at'  => $log->created_at,
        ]);

        return response()->json($logs);
    }

    /**
     * Actions disponibles dans le journal
     *
     * Retourne la liste des types d'actions enregistrés.
     *
     * @response ["paiement.enregistre", "cycle.ouvert", "cycle.ferme"]
     */
    public function actionsDisponibles(): JsonResponse
    {
        $actions = AuditLog::distinct()->pluck('action')->sort()->values();

        return response()->json($actions);
    }
}
