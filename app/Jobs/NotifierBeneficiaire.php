<?php

namespace App\Jobs;

use App\Models\Cycle;
use App\Models\Tontine;
use App\Notifications\BeneficiaireNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Notifie le bénéficiaire d'un cycle qu'il va recevoir la cagnotte.
 */
class NotifierBeneficiaire implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public function __construct(
        public readonly Tontine $tontine,
        public readonly Cycle   $cycle,
    ) {}

    public function handle(): void
    {
        if (! $this->cycle->beneficiaire) {
            return;
        }

        $this->cycle->beneficiaire->notify(
            new BeneficiaireNotification($this->tontine, $this->cycle)
        );
    }
}
