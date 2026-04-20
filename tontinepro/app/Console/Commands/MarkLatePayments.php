<?php

namespace App\Console\Commands;

use App\Models\Cycle;
use App\Models\Payment;
use Illuminate\Console\Command;

class MarkLatePayments extends Command
{
    /**
     * Le nom et la signature de la commande.
     */
    protected $signature = 'tontine:mark-late';

    /**
     * La description de la commande.
     */
    protected $description = 'Marque automatiquement en retard les paiements non effectués des cycles ouverts depuis plus d\'une période.';

    /**
     * Exécution de la commande.
     */
    public function handle(): void
    {
        // On considère comme "en retard" tout membre d'un cycle ouvert
        // depuis plus de 3 jours et qui n'a pas encore payé
        $openCycles = Cycle::whereNull('closed_at')
            ->whereNotNull('opened_at')
            ->where('opened_at', '<', now()->subDays(3))
            ->with('tontine.members')
            ->get();

        $count = 0;

        foreach ($openCycles as $cycle) {
            $memberIds = $cycle->tontine->members->pluck('id');

            foreach ($memberIds as $memberId) {
                $alreadyPaid = Payment::where('cycle_id', $cycle->id)
                    ->where('user_id', $memberId)
                    ->where('status', 'payé')
                    ->exists();

                if (!$alreadyPaid) {
                    Payment::updateOrCreate(
                        [
                            'cycle_id' => $cycle->id,
                            'user_id'  => $memberId,
                        ],
                        [
                            'amount' => $cycle->tontine->amount_per_cycle,
                            'status' => 'en retard',
                            'paid_at' => null,
                        ]
                    );
                    $count++;
                }
            }
        }

        $this->info("✅ {$count} paiement(s) marqué(s) en retard.");
    }
}
