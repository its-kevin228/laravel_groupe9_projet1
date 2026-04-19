<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cycle;
use App\Models\Payment;
use App\Models\Tontine;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * @group Admin — Export PDF
 * @authenticated
 *
 * Téléchargement de rapports PDF pour les tontines.
 */
class ExportController extends Controller
{
    /**
     * Export liste des membres
     *
     * Génère un PDF avec la liste complète des membres d'une tontine.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     *
     * @response file Le fichier PDF est retourné en téléchargement.
     */
    public function membres(Tontine $tontine): Response
    {
        $membres = $tontine->membres()
            ->select('users.id', 'users.first_name', 'users.last_name', 'users.phone', 'users.email', 'users.ordre_passage', 'users.date_adhesion', 'users.exclu_at')
            ->orderBy('users.ordre_passage')
            ->get();

        $pdf = Pdf::loadView('pdf.membres', compact('tontine', 'membres'))
            ->setPaper('a4', 'portrait');

        $filename = 'membres_' . str($tontine->nom)->slug() . '_' . now()->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export rapport paiements
     *
     * Génère un PDF avec le rapport des paiements d'une tontine.
     * Peut être filtré par cycle.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @queryParam cycle_id integer Filtrer par cycle. Example: 1
     *
     * @response file Le fichier PDF est retourné en téléchargement.
     */
    public function paiements(Request $request, Tontine $tontine): Response
    {
        $cycleId = $request->query('cycle_id');
        $cycle   = null;

        $query = Payment::with([
            'membre:id,first_name,last_name',
            'cycle:id,numero_cycle,tontine_id,date_ouverture,date_fermeture',
            'enregistrePar:id,first_name,last_name',
        ])->whereHas('cycle', fn($q) => $q->where('tontine_id', $tontine->id));

        if ($cycleId) {
            $cycle = Cycle::where('tontine_id', $tontine->id)->findOrFail($cycleId);
            $query->where('cycle_id', $cycleId);
        }

        $paiements = $query->orderBy('paid_at')->get();

        $stats = [
            'total_paiements' => $paiements->count(),
            'total_collecte'  => $paiements->sum(fn($p) => (float) $p->montant),
            'paye'            => $paiements->where('statut', 'paye')->count(),
            'en_retard'       => $paiements->where('statut', 'en_retard')->count(),
        ];

        $pdf = Pdf::loadView('pdf.paiements', compact('tontine', 'cycle', 'paiements', 'stats'))
            ->setPaper('a4', 'landscape');

        $suffix   = $cycle ? '_cycle' . $cycle->numero_cycle : '_tous_cycles';
        $filename = 'paiements_' . str($tontine->nom)->slug() . $suffix . '_' . now()->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Export historique tontine
     *
     * Génère un PDF avec l'historique complet d'une tontine :
     * cycles, bénéficiaires, statistiques de collecte.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     *
     * @response file Le fichier PDF est retourné en téléchargement.
     */
    public function historique(Tontine $tontine): Response
    {
        $tontine->load(['cycles.beneficiaire:id,first_name,last_name', 'cycles.payments']);

        $cycles = $tontine->cycles->map(fn($c) => [
            'numero_cycle'   => $c->numero_cycle,
            'statut'         => $c->statut,
            'beneficiaire'   => $c->beneficiaire?->full_name,
            'date_ouverture' => $c->date_ouverture,
            'date_fermeture' => $c->date_fermeture,
            'ont_paye'       => $c->payments->where('statut', 'paye')->count(),
            'en_retard'      => $c->payments->where('statut', 'en_retard')->count(),
            'total_collecte' => $c->payments->where('statut', 'paye')->sum(fn($p) => (float) $p->montant),
        ]);

        $totalCollecte = $cycles->sum('total_collecte');
        $totalAttendu  = $tontine->cycles->count() * $tontine->membres()->count() * (float) $tontine->montant_cotisation;

        $stats = [
            'total_membres'     => $tontine->membres()->count(),
            'total_cycles'      => $tontine->cycles->count(),
            'total_collecte'    => $totalCollecte,
            'taux_recouvrement' => $totalAttendu > 0 ? round(($totalCollecte / $totalAttendu) * 100, 1) : 0,
        ];

        $pdf = Pdf::loadView('pdf.historique_tontine', compact('tontine', 'cycles', 'stats'))
            ->setPaper('a4', 'landscape');

        $filename = 'historique_' . str($tontine->nom)->slug() . '_' . now()->format('Ymd') . '.pdf';

        return $pdf->download($filename);
    }
}
