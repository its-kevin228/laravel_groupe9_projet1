<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cycle;
use App\Models\Payment;
use App\Models\Tontine;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Admin — Dashboard Statistiques
 * @authenticated
 *
 * Vue d'ensemble globale et par tontine pour l'administrateur.
 */
class StatsDashboardController extends Controller
{
    /**
     * Statistiques globales
     *
     * Retourne un résumé complet de toutes les tontines :
     * membres, cotisations, retards, cycles en cours.
     *
     * @response {
     *   "membres": { "total": 24, "actifs": 20 },
     *   "tontines": { "total": 3, "actives": 2, "en_attente": 1, "terminees": 0 },
     *   "cotisations": {
     *     "total_collecte": "480000.00",
     *     "total_attendu": "600000.00",
     *     "taux_recouvrement": "80.00"
     *   },
     *   "paiements_en_retard": { "nombre": 4, "montant": "20000.00" },
     *   "cycles_en_cours": [
     *     {
     *       "tontine": "Tontine Solidarité",
     *       "cycle_numero": 2,
     *       "beneficiaire": "Alice Dupont",
     *       "ont_paye": 18,
     *       "en_retard": 2,
     *       "date_fermeture": "2026-02-28"
     *     }
     *   ]
     * }
     */
    public function global(): JsonResponse
    {
        // Membres
        $totalMembres  = User::where('role', 'membre')->count();
        $membresActifs = User::where('role', 'membre')
            ->whereNotNull('tontine_id')
            ->count();

        // Tontines par statut
        $tontinesStats = Tontine::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN statut = 'active'     THEN 1 ELSE 0 END) as actives,
            SUM(CASE WHEN statut = 'en_attente' THEN 1 ELSE 0 END) as en_attente,
            SUM(CASE WHEN statut = 'terminee'   THEN 1 ELSE 0 END) as terminees,
            SUM(CASE WHEN statut = 'archivee'   THEN 1 ELSE 0 END) as archivees
        ")->first();

        // Cotisations
        $totalCollecte = Payment::where('statut', 'paye')->sum('montant');
        $totalAttendu  = $this->calculerMontantAttendu();
        $tauxRecouvrement = $totalAttendu > 0
            ? round(($totalCollecte / $totalAttendu) * 100, 2)
            : 0;

        // Paiements en retard
        $retards = Payment::where('statut', 'en_retard');

        // Cycles en cours
        $cyclesEnCours = Cycle::where('statut', 'ouvert')
            ->with(['tontine:id,nom,montant_cotisation', 'beneficiaire:id,first_name,last_name'])
            ->get()
            ->map(function (Cycle $cycle) {
                $totalMembres = $cycle->tontine->membres()->count();
                $ontPaye      = $cycle->payments()->where('statut', 'paye')->count();

                return [
                    'tontine_id'     => $cycle->tontine_id,
                    'tontine'        => $cycle->tontine->nom,
                    'cycle_id'       => $cycle->id,
                    'cycle_numero'   => $cycle->numero_cycle,
                    'beneficiaire'   => $cycle->beneficiaire?->full_name,
                    'total_membres'  => $totalMembres,
                    'ont_paye'       => $ontPaye,
                    'en_retard'      => $totalMembres - $ontPaye,
                    'date_ouverture' => $cycle->date_ouverture,
                    'date_fermeture' => $cycle->date_fermeture,
                ];
            });

        return response()->json([
            'membres' => [
                'total'  => $totalMembres,
                'actifs' => $membresActifs,
            ],
            'tontines' => [
                'total'      => (int) $tontinesStats->total,
                'actives'    => (int) $tontinesStats->actives,
                'en_attente' => (int) $tontinesStats->en_attente,
                'terminees'  => (int) $tontinesStats->terminees,
                'archivees'  => (int) $tontinesStats->archivees,
            ],
            'cotisations' => [
                'total_collecte'     => number_format($totalCollecte, 2, '.', ''),
                'total_attendu'      => number_format($totalAttendu, 2, '.', ''),
                'taux_recouvrement'  => $tauxRecouvrement,
            ],
            'paiements_en_retard' => [
                'nombre'  => $retards->count(),
                'montant' => number_format($retards->sum('montant'), 2, '.', ''),
            ],
            'cycles_en_cours' => $cyclesEnCours,
        ]);
    }

    /**
     * Statistiques d'une tontine
     *
     * Détail complet des statistiques pour une tontine spécifique.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     *
     * @response {
     *   "tontine": { "id": 1, "nom": "Tontine Solidarité", "statut": "active" },
     *   "membres": { "total": 8, "liste": [] },
     *   "cycles": { "total": 3, "fermes": 2, "en_cours": 1 },
     *   "cotisations": {
     *     "total_collecte": "160000.00",
     *     "total_attendu": "200000.00",
     *     "taux_recouvrement": "80.00"
     *   },
     *   "paiements_en_retard": { "nombre": 2, "membres": [] },
     *   "cycle_actif": { "numero_cycle": 3, "beneficiaire": "Bob Martin" },
     *   "historique_cycles": []
     * }
     */
    public function parTontine(Tontine $tontine): JsonResponse
    {
        $membres = $tontine->membres()
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.phone', 'users.ordre_passage')
            ->orderBy('users.ordre_passage')
            ->get();

        $cycleIds    = $tontine->cycles()->pluck('id');
        $totalCycles = $tontine->cycles()->count();
        $cyclesFermes = $tontine->cycles()->where('statut', 'ferme')->count();
        $cycleActif  = $tontine->cycleActif();

        // Cotisations
        $totalCollecte = Payment::whereIn('cycle_id', $cycleIds)
            ->where('statut', 'paye')
            ->sum('montant');

        $totalAttendu = $totalCycles * $membres->count() * (float) $tontine->montant_cotisation;

        $tauxRecouvrement = $totalAttendu > 0
            ? round(($totalCollecte / $totalAttendu) * 100, 2)
            : 0;

        // Membres en retard sur le cycle actif
        $membresEnRetard = [];
        if ($cycleActif) {
            $dejaPaye = Payment::where('cycle_id', $cycleActif->id)->pluck('user_id')->toArray();
            $membresEnRetard = $membres->whereNotIn('id', $dejaPaye)->values();
        }

        // Historique des cycles
        $historiqueCycles = $tontine->cycles()
            ->with('beneficiaire:id,first_name,last_name')
            ->orderBy('numero_cycle')
            ->get()
            ->map(fn($c) => [
                'cycle_numero'   => $c->numero_cycle,
                'statut'         => $c->statut,
                'beneficiaire'   => $c->beneficiaire?->full_name,
                'date_ouverture' => $c->date_ouverture,
                'date_fermeture' => $c->date_fermeture,
                'ont_paye'       => $c->payments()->where('statut', 'paye')->count(),
                'en_retard'      => $c->payments()->where('statut', 'en_retard')->count(),
            ]);

        return response()->json([
            'tontine' => $tontine->only(['id', 'nom', 'montant_cotisation', 'frequence', 'statut', 'date_debut']),
            'membres' => [
                'total' => $membres->count(),
                'liste' => $membres,
            ],
            'cycles' => [
                'total'    => $totalCycles,
                'fermes'   => $cyclesFermes,
                'en_cours' => $cycleActif ? 1 : 0,
            ],
            'cotisations' => [
                'total_collecte'    => number_format($totalCollecte, 2, '.', ''),
                'total_attendu'     => number_format($totalAttendu, 2, '.', ''),
                'taux_recouvrement' => $tauxRecouvrement,
            ],
            'paiements_en_retard' => [
                'nombre'  => count($membresEnRetard),
                'membres' => $membresEnRetard,
            ],
            'cycle_actif'      => $cycleActif ? [
                'id'             => $cycleActif->id,
                'numero_cycle'   => $cycleActif->numero_cycle,
                'beneficiaire'   => $cycleActif->beneficiaire?->full_name,
                'date_ouverture' => $cycleActif->date_ouverture,
                'date_fermeture' => $cycleActif->date_fermeture,
            ] : null,
            'historique_cycles' => $historiqueCycles,
        ]);
    }

    // -------------------------------------------------------------------------

    private function calculerMontantAttendu(): float
    {
        return Tontine::with(['membres', 'cycles'])->get()->sum(function (Tontine $tontine) {
            return $tontine->cycles()->count()
                * $tontine->membres()->count()
                * (float) $tontine->montant_cotisation;
        });
    }
}
