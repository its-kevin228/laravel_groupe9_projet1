<?php

namespace App\Http\Controllers;

use App\Models\Cycle;
use App\Models\Payment;
use App\Models\Tontine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Enregistre un paiement pour un membre dans un cycle.
     * Réservé à l'Organisateur via PaymentPolicy.
     */
    public function store(Request $request, Tontine $tontine, Cycle $cycle): RedirectResponse
    {
        $this->authorize('create', Payment::class);

        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
        ]);

        // Vérification si un paiement "payé" existe déjà pour éviter les doublons
        $exists = Payment::where('cycle_id', $cycle->id)
            ->where('user_id', $validated['user_id'])
            ->where('status', 'payé')
            ->exists();

        if ($exists) {
            return back()->with('error', "Ce membre a déjà payé pour ce cycle.");
        }

        // Création ou mise à jour (si c'était en retard, ça passe à payé)
        Payment::updateOrCreate(
            [
                'cycle_id' => $cycle->id,
                'user_id'  => $validated['user_id'],
            ],
            [
                'amount'  => $tontine->amount_per_cycle,
                'paid_at' => now(),
                'status'  => 'payé',
            ]
        );

        return back()->with('success', "✅ Paiement enregistré avec succès.");
    }
}
