<?php

namespace App\Jobs;

use App\Models\Cycle;
use App\Models\Payment;
use App\Models\Tontine;
use App\Notifications\RetardPaiementNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Alerte les membres en retard de paiement
 * (cycle ouvert dont la date_fermeture est dépassée).
 */
class EnvoyerAlerteRetard implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public function __construct(
        public readonly Tontine $tontine,
        public readonly Cycle   $cycle,
    ) {}

    public function handle(): void
    {
        // Seulement si la date limite est dépassée
        if (! $this->cycle->date_fermeture || now()->lte($this->cycle->date_fermeture)) {
            return;
        }

        $dejaPaye = Payment::where('cycle_id', $this->cycle->id)
            ->pluck('user_id')
            ->toArray();

        $this->tontine->membres()
            ->whereNotIn('users.id', $dejaPaye)
            ->get()
            ->each(fn($membre) =>
                $membre->notify(new RetardPaiementNotification($this->tontine, $this->cycle))
            );
    }
}
