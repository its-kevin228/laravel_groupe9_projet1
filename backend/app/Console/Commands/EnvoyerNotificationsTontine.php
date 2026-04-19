<?php

namespace App\Console\Commands;

use App\Jobs\EnvoyerAlerteRetard;
use App\Jobs\EnvoyerRappelPaiement;
use App\Models\Cycle;
use App\Models\Tontine;
use Illuminate\Console\Command;

class EnvoyerNotificationsTontine extends Command
{
    protected $signature   = 'tontine:notifier
                                {--type=all : Type de notification (rappel|retard|all)}
                                {--tontine= : ID d\'une tontine spécifique (optionnel)}
                                {--jours=3 : Envoyer rappel X jours avant la date limite}';

    protected $description = 'Envoie les rappels et alertes de paiement pour les cycles actifs';

    public function handle(): int
    {
        $type      = $this->option('type');
        $tontineId = $this->option('tontine');
        $jours     = (int) $this->option('jours');

        $query = Tontine::whereHas('cycles', fn($q) => $q->where('statut', 'ouvert'));

        if ($tontineId) {
            $query->where('id', $tontineId);
        }

        $tontines = $query->with(['cycles' => fn($q) => $q->where('statut', 'ouvert')])->get();

        if ($tontines->isEmpty()) {
            $this->info('Aucun cycle actif trouvé.');
            return self::SUCCESS;
        }

        $rappels = 0;
        $retards = 0;

        foreach ($tontines as $tontine) {
            $cycle = $tontine->cycles->first();
            if (! $cycle) continue;

            // Rappel : X jours avant la date limite
            if (in_array($type, ['rappel', 'all'])) {
                $dateLimite = $cycle->date_fermeture;
                if ($dateLimite && now()->diffInDays($dateLimite, false) <= $jours && now()->lte($dateLimite)) {
                    EnvoyerRappelPaiement::dispatch($tontine, $cycle);
                    $rappels++;
                    $this->line("  ✅ Rappel dispatché → {$tontine->nom} (cycle {$cycle->numero_cycle})");
                }
            }

            // Alerte retard : date limite dépassée
            if (in_array($type, ['retard', 'all'])) {
                $dateLimite = $cycle->date_fermeture;
                if ($dateLimite && now()->gt($dateLimite)) {
                    EnvoyerAlerteRetard::dispatch($tontine, $cycle);
                    $retards++;
                    $this->line("  🚨 Alerte retard dispatché → {$tontine->nom} (cycle {$cycle->numero_cycle})");
                }
            }
        }

        $this->info("Terminé — {$rappels} rappel(s), {$retards} alerte(s) retard dispatché(s).");

        return self::SUCCESS;
    }
}
