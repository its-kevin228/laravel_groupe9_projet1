<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Tontine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CycleController extends Controller
{
    /**
     * Ouvre un nouveau cycle pour une tontine.
     * Seul l'admin peut le faire.
     */
    public function store(Request $request, Tontine $tontine): RedirectResponse
    {
        $this->authorize('create', Tontine::class);

        $validated = $request->validate([
            'beneficiary_user_id' => ['required', 'exists:users,id'],
        ]);

        // Calcul du prochain numéro de cycle
        $nextNumber = $tontine->cycles()->max('cycle_number') + 1;

        $cycle = $tontine->cycles()->create([
            'cycle_number'        => $nextNumber,
            'beneficiary_user_id' => $validated['beneficiary_user_id'],
            'opened_at'           => now(),
        ]);

        return redirect()
            ->route('tontines.show', $tontine)
            ->with('success', "Cycle #{$cycle->cycle_number} ouvert avec succès.");
    }

    /**
     * Clôture un cycle (ferme les paiements).
     * Seul l'admin peut le faire.
     */
    public function close(Request $request, Tontine $tontine, Cycle $cycle): RedirectResponse
    {
        $this->authorize('create', Tontine::class);

        if ($cycle->closed_at) {
            return back()->with('error', 'Ce cycle est déjà clôturé.');
        }

        // Marquer en retard les membres qui n'ont pas payé
        $memberIds = $tontine->members()->pluck('users.id');

        foreach ($memberIds as $memberId) {
            $alreadyPaid = $cycle->payments()
                ->where('user_id', $memberId)
                ->where('status', 'payé')
                ->exists();

            if (!$alreadyPaid) {
                // Créer ou mettre à jour le paiement en retard
                $cycle->payments()->updateOrCreate(
                    ['cycle_id' => $cycle->id, 'user_id' => $memberId],
                    ['amount' => $tontine->amount_per_cycle, 'status' => 'en retard']
                );
            }
        }

        $cycle->update(['closed_at' => now()]);

        // Si tous les membres ont bénéficié, clôturer la tontine
        $totalMembers = $tontine->members()->count();
        $totalCycles  = $tontine->cycles()->whereNotNull('closed_at')->count();

        if ($totalCycles >= $totalMembers) {
            $tontine->update(['status' => 'clôturée']);
        }

        return redirect()
            ->route('tontines.show', $tontine)
            ->with('success', "Cycle #{$cycle->cycle_number} clôturé avec succès.");
    }
}
