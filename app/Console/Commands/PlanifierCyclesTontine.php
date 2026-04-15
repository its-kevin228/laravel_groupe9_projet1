<?php

namespace App\Console\Commands;

use App\Jobs\PlanifierProchainCycle;
use App\Models\Tontine;
use Illuminate\Console\Command;

class PlanifierCyclesTontine extends Command
{
    protected $signature = 'tontine:planifier-cycles
                                {--tontine= : ID d\'une tontine spécifique (optionnel)}
                                {--force : Forcer même si la date n\'est pas encore dépassée}';

    protected $description = 'Ferme les cycles échus et ouvre automatiquement les suivants';

    public function handle(): int
    {
        $tontineId = $this->option('tontine');

        // Tontines actives avec un cycle ouvert
        $query = Tontine::where('statut', 'active')
            ->whereHas('cycles', fn($q) => $q->where('statut', 'ouvert'));

        if ($tontineId) {
            $query->where('id', $tontineId);
        }

        $tontines = $query->get();

        if ($tontines->isEmpty()) {
            $this->info('Aucune tontine active avec un cycle ouvert trouvée.');
            return self::SUCCESS;
        }

        $this->info("Traitement de {$tontines->count()} tontine(s)...");

        foreach ($tontines as $tontine) {
            $cycle = $tontine->cycleActif();

            if (! $cycle) continue;

            $force = $this->option('force');
            $echu  = $cycle->date_fermeture && now()->gte($cycle->date_fermeture);

            if ($force || $echu) {
                PlanifierProchainCycle::dispatch($tontine);
                $this->line("  ✅ Planification dispatché → {$tontine->nom} (cycle {$cycle->numero_cycle})");
            } else {
                $jours = $cycle->date_fermeture
                    ? now()->diffInDays($cycle->date_fermeture, false)
                    : '?';
                $this->line("  ⏳ {$tontine->nom} — cycle {$cycle->numero_cycle} échu dans {$jours} jour(s)");
            }
        }

        $this->info('Terminé.');
        return self::SUCCESS;
    }
}
