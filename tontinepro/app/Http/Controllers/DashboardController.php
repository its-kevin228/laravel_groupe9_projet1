<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Tontine;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return $this->adminDashboard();
        }

        return $this->memberDashboard();
    }

    /**
     * Dashboard Organisateur (Admin).
     */
    private function adminDashboard(): View
    {
        $tontines = Tontine::withCount('members')
            ->with(['cycles' => fn($q) => $q->whereNull('closed_at')->with('beneficiary')])
            ->latest()
            ->get();

        // Paiements en retard globaux
        $latePayments = Payment::with(['user', 'cycle.tontine'])
            ->where('status', 'en retard')
            ->latest()
            ->take(10)
            ->get();

        $stats = [
            'total_tontines'  => Tontine::count(),
            'active_tontines' => Tontine::where('status', 'active')->count(),
            'total_members'   => \App\Models\User::where('role', 'member')->count(),
            'late_payments'   => Payment::where('status', 'en retard')->count(),
        ];

        return view('dashboard.admin', compact('tontines', 'latePayments', 'stats'));
    }

    /**
     * Dashboard Membre.
     */
    private function memberDashboard(): View
    {
        $user = auth()->user();

        // Tontines du membre avec informations pivot
        $tontines = $user->tontines()
            ->with([
                'cycles' => fn($q) => $q->orderBy('cycle_number'),
                'cycles.beneficiary',
            ])
            ->withCount('members')
            ->get();

        foreach ($tontines as $tontine) {
            // Cagnotte totale
            $tontine->pot_size = $tontine->members_count * $tontine->amount_per_cycle;
            
            // Prochain versement estimé
            $lastCycle = $tontine->cycles->sortByDesc('cycle_number')->first();
            if ($lastCycle && $lastCycle->opened_at) {
                $daysToAdd = match($tontine->frequency) {
                    'hebdomadaire' => 7,
                    'mensuel'      => 30,
                    'bimestriel'   => 60,
                    'trimestriel'  => 90,
                    default        => 30
                };
                $tontine->next_payment_date = $lastCycle->opened_at->addDays($daysToAdd);
            } else {
                $tontine->next_payment_date = null;
            }
        }

        // Contributions versées par ce membre
        $paidPayments = Payment::where('user_id', $user->id)
            ->where('status', 'payé')
            ->with('cycle.tontine')
            ->latest('paid_at')
            ->get();

        // Paiements en retard de ce membre
        $latePayments = Payment::where('user_id', $user->id)
            ->where('status', 'en retard')
            ->with('cycle.tontine')
            ->get();

        $totalPaid  = $paidPayments->sum('amount');
        $totalLate  = $latePayments->sum('amount');

        return view('dashboard.member', compact(
            'tontines',
            'paidPayments',
            'latePayments',
            'totalPaid',
            'totalLate'
        ));
    }
}
