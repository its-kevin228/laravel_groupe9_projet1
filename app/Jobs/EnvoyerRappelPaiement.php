<?php

namespace App\Jobs;

use App\Models\Cycle;
use App\Models\Payment;
use App\Models\Tontine;
use App\Notifications\RappelPaiementNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Envoie un rappel de paiement à tous les membres
 * qui n'ont pas encore payé pour le cycle actif.
 */
class EnvoyerRappelPaiement implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public function __construct(
        public readonly Tontine $tontine,
        public readonly Cycle   $cycle,
    ) {}

    public function handle(): void
    {
        // IDs des membres ayant déjà payé ce cycle
        $dejaPaye = Payment::where('cycle_id', $this->cycle->id)
            ->pluck('user_id')
            ->toArray();

        // Membres qui n'ont pas encore payé
        $this->tontine->membres()
            ->whereNotIn('users.id', $dejaPaye)
            ->get()
            ->each(fn($membre) =>
                $membre->notify(new RappelPaiementNotification($this->tontine, $this->cycle))
            );
    }
}
