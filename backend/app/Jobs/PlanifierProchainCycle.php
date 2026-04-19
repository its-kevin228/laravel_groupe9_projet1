<?php

namespace App\Jobs;

use App\Models\AuditLog;
use App\Models\Cycle;
use App\Models\Tontine;
use App\Notifications\BeneficiaireNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Ferme le cycle actif d'une tontine (si la date_fermeture est dépassée)
 * et ouvre automatiquement le cycle suivant.
 */
class PlanifierProchainCycle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public function __construct(
        public readonly Tontine $tontine,
    ) {}

    public function handle(): void
    {
        $cycleActif = $this->tontine->cycleActif();

        // Pas de cycle ouvert → rien à faire
        if (! $cycleActif) {
            Log::info("[PlanifierProchainCycle] Tontine #{$this->tontine->id} : aucun cycle ouvert.");
            return;
        }

        // La date de fermeture n'est pas encore dépassée → trop tôt
        if ($cycleActif->date_fermeture && Carbon::now()->lt($cycleActif->date_fermeture)) {
            Log::info("[PlanifierProchainCycle] Tontine #{$this->tontine->id} : cycle #{$cycleActif->numero_cycle} pas encore échu.");
            return;
        }

        DB::transaction(function () use ($cycleActif) {
            // 1. Fermer le cycle actif
            $dateFermeture = $cycleActif->date_fermeture ?? Carbon::now()->toDateString();
            $cycleActif->update([
                'statut'         => 'ferme',
                'date_fermeture' => $dateFermeture,
            ]);

            AuditLog::journaliser('cycle.ferme.auto', $cycleActif, [
                'tontine_id'    => $this->tontine->id,
                'tontine_nom'   => $this->tontine->nom,
                'numero_cycle'  => $cycleActif->numero_cycle,
                'date_fermeture'=> $dateFermeture,
            ]);

            Log::info("[PlanifierProchainCycle] Tontine #{$this->tontine->id} : cycle #{$cycleActif->numero_cycle} fermé automatiquement.");

            // 2. Déterminer le prochain bénéficiaire
            $beneficiaire = $this->tontine->prochainBeneficiaire();

            if (! $beneficiaire) {
                Log::warning("[PlanifierProchainCycle] Tontine #{$this->tontine->id} : aucun bénéficiaire disponible.");
                return;
            }

            // 3. Calculer les dates du prochain cycle
            $dateOuverture  = Carbon::parse($dateFermeture)->addDay();
            $dateFermetureN = $this->tontine->dateFermetureCycle($dateOuverture);

            // 4. Ouvrir le nouveau cycle
            $nouveauCycle = Cycle::create([
                'tontine_id'         => $this->tontine->id,
                'numero_cycle'       => $this->tontine->prochainNumeroCycle(),
                'beneficiaire_id'    => $beneficiaire->id,
                'ordre_beneficiaire' => $beneficiaire->ordre_passage,
                'statut'             => 'ouvert',
                'date_ouverture'     => $dateOuverture->toDateString(),
                'date_fermeture'     => $dateFermetureN->toDateString(),
            ]);

            AuditLog::journaliser('cycle.ouvert.auto', $nouveauCycle, [
                'tontine_id'      => $this->tontine->id,
                'tontine_nom'     => $this->tontine->nom,
                'numero_cycle'    => $nouveauCycle->numero_cycle,
                'beneficiaire_id' => $beneficiaire->id,
                'beneficiaire'    => $beneficiaire->full_name,
                'date_ouverture'  => $dateOuverture->toDateString(),
                'date_fermeture'  => $dateFermetureN->toDateString(),
            ]);

            Log::info("[PlanifierProchainCycle] Tontine #{$this->tontine->id} : cycle #{$nouveauCycle->numero_cycle} ouvert → bénéficiaire {$beneficiaire->full_name}.");

            // 5. Notifier le bénéficiaire
            $beneficiaire->notify(new BeneficiaireNotification($this->tontine, $nouveauCycle));
        });
    }
}
