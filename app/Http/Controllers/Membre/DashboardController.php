<?php

namespace App\Http\Controllers\Membre;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Tontine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Membre — Tableau de bord
 * @authenticated
 *
 * Vue personnelle du membre : contributions, solde, prochain versement, position.
 */
class DashboardController extends Controller
{
    /**
     * Tableau de bord global du membre
     *
     * Retourne un résumé complet pour toutes les tontines du membre :
     * contributions versées, solde restant, prochain versement, position dans l'ordre.
     *
     * @response {
     *   "membre": { "id": 3, "nom_complet": "Alice Dupont", "phone": "+22890000000" },
     *   "tontines": [
     *     {
     *       "tontine": { "id": 1, "nom": "Tontine Solidarité", "montant_cotisation": "5000.00", "frequence": "mensuel" },
     *       "position": 2,
     *       "total_cycles": 6,
     *       "contributions_versees": { "nombre": 4, "montant_total": "20000.00" },
     *       "en_retard": { "nombre": 1, "montant": "5000.00" },
     *       "solde_restant": "10000.00",
     *       "est_beneficiaire_cycle_actif": false,
     *       "cycle_actif": { "id": 2, "numero_cycle": 2, "statut": "ouvert", "date_ouverture": "2026-02-01" },
     *       "prochain_versement": { "cycle_numero": 2, "montant": "5000.00", "statut": "en_attente" },
     *       "historique_paiements": []
     *     }
     *   ]
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $membre = $request->user();

        // Toutes les tontines du membre via FK tontine_id
        $tontines = Tontine::whereHas('membres', fn($q) => $q->where('users.id', $membre->id))
            ->with(['cycles' => fn($q) => $q->orderBy('numero_cycle')])
            ->get();

        $data = $tontines->map(fn($tontine) => $this->buildTontineStats($membre, $tontine));

        return response()->json([
            'membre'   => [
                'id'          => $membre->id,
                'nom_complet' => $membre->full_name,
                'phone'       => $membre->phone,
                'email'       => $membre->email,
            ],
            'tontines' => $data,
        ]);
    }

    /**
     * Tableau de bord pour une tontine spécifique
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     *
     * @response {
     *   "tontine": { "id": 1, "nom": "Tontine Solidarité" },
     *   "position": 2,
     *   "contributions_versees": { "nombre": 4, "montant_total": "20000.00" },
     *   "solde_restant": "10000.00",
     *   "prochain_versement": { "cycle_numero": 2, "montant": "5000.00", "statut": "en_attente" }
     * }
     */
    public function tontine(Request $request, Tontine $tontine): JsonResponse
    {
        $membre = $request->user();

        // Vérifier que le membre appartient à cette tontine
        $appartient = $tontine->membres()->where('users.id', $membre->id)->exists();
        if (! $appartient) {
            return response()->json(['message' => 'Vous n\'appartenez pas à cette tontine.'], 403);
        }

        return response()->json($this->buildTontineStats($membre, $tontine->load('cycles')));
    }

    /**
     * Historique complet des paiements du membre pour une tontine
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     *
     * @response [
     *   { "cycle_numero": 1, "montant": "5000.00", "statut": "paye", "paid_at": "2026-01-10" },
     *   { "cycle_numero": 2, "montant": "5000.00", "statut": "en_retard", "paid_at": "2026-02-15" }
     * ]
     */
    public function historique(Request $request, Tontine $tontine): JsonResponse
    {
        $membre = $request->user();

        $appartient = $tontine->membres()->where('users.id', $membre->id)->exists();
        if (! $appartient) {
            return response()->json(['message' => 'Vous n\'appartenez pas à cette tontine.'], 403);
        }

        $paiements = Payment::whereHas('cycle', fn($q) => $q->where('tontine_id', $tontine->id))
            ->where('user_id', $membre->id)
            ->with('cycle:id,numero_cycle,date_ouverture,date_fermeture,statut')
            ->orderBy('paid_at', 'desc')
            ->get()
            ->map(fn($p) => [
                'cycle_numero'   => $p->cycle->numero_cycle,
                'cycle_statut'   => $p->cycle->statut,
                'montant'        => $p->montant,
                'statut'         => $p->statut,
                'paid_at'        => $p->paid_at,
                'note'           => $p->note,
            ]);

        return response()->json($paiements);
    }

    // -------------------------------------------------------------------------
    // Helpers privés
    // -------------------------------------------------------------------------

    private function buildTontineStats($membre, Tontine $tontine): array
    {
        $membreData = $tontine->membres()->where('users.id', $membre->id)->first();
        $position   = $membreData?->ordre_passage;

        $cycleIds = $tontine->cycles->pluck('id');

        // Tous les paiements du membre dans cette tontine
        $paiements = Payment::whereIn('cycle_id', $cycleIds)
            ->where('user_id', $membre->id)
            ->get();

        $totalCycles       = $tontine->cycles->count();
        $montantCotisation = (float) $tontine->montant_cotisation;

        // Contributions versées
        $paye     = $paiements->where('statut', 'paye');
        $enRetard = $paiements->where('statut', 'en_retard');

        $montantTotalPaye = $paiements->sum(fn($p) => (float) $p->montant);

        // Solde restant = (total cycles) × montant - ce qui a été payé
        $montantAttendu = $totalCycles * $montantCotisation;
        $soldeRestant   = max(0, $montantAttendu - $montantTotalPaye);

        // Cycle actif
        $cycleActif = $tontine->cycles->firstWhere('statut', 'ouvert');

        // Est-il bénéficiaire du cycle actif ?
        $estBeneficiaire = $cycleActif && $cycleActif->beneficiaire_id === $membre->id;

        // Prochain versement
        $prochainVersement = $this->prochainVersement($membre->id, $cycleActif, $montantCotisation);

        return [
            'tontine'                      => $tontine->only(['id', 'nom', 'montant_cotisation', 'frequence', 'statut']),
            'position'                     => $position,
            'total_cycles'                 => $totalCycles,
            'contributions_versees'        => [
                'nombre'        => $paye->count(),
                'montant_total' => number_format($paye->sum(fn($p) => (float) $p->montant), 2, '.', ''),
            ],
            'en_retard'                    => [
                'nombre'  => $enRetard->count(),
                'montant' => number_format($enRetard->sum(fn($p) => (float) $p->montant), 2, '.', ''),
            ],
            'solde_restant'                => number_format($soldeRestant, 2, '.', ''),
            'est_beneficiaire_cycle_actif' => $estBeneficiaire,
            'cycle_actif'                  => $cycleActif?->only(['id', 'numero_cycle', 'statut', 'date_ouverture', 'date_fermeture']),
            'prochain_versement'           => $prochainVersement,
        ];
    }

    private function prochainVersement($membreId, $cycleActif, float $montantCotisation): ?array
    {
        if (! $cycleActif) {
            return null;
        }

        $dejaPaye = Payment::where('cycle_id', $cycleActif->id)
            ->where('user_id', $membreId)
            ->exists();

        return [
            'cycle_numero' => $cycleActif->numero_cycle,
            'montant'      => number_format($montantCotisation, 2, '.', ''),
            'statut'       => $dejaPaye ? 'paye' : 'en_attente',
            'date_limite'  => $cycleActif->date_fermeture,
        ];
    }
}
