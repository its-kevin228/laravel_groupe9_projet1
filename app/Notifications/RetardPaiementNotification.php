<?php

namespace App\Notifications;

use App\Models\Cycle;
use App\Models\Tontine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RetardPaiementNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Tontine $tontine,
        public readonly Cycle   $cycle,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("🚨 Retard de paiement — {$this->tontine->nom}")
            ->greeting("Bonjour {$notifiable->first_name},")
            ->error()
            ->line("Votre cotisation pour la tontine **{$this->tontine->nom}** est en retard.")
            ->line("Cycle n° **{$this->cycle->numero_cycle}** — Montant dû : **{$this->tontine->montant_cotisation} FCFA**")
            ->when($this->cycle->date_fermeture, fn($mail) =>
                $mail->line("La date limite du **{$this->cycle->date_fermeture->format('d/m/Y')}** est dépassée.")
            )
            ->action('Régulariser maintenant', config('app.url'))
            ->line('Veuillez contacter votre organisateur si nécessaire.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'          => 'retard_paiement',
            'tontine_id'    => $this->tontine->id,
            'tontine_nom'   => $this->tontine->nom,
            'cycle_id'      => $this->cycle->id,
            'cycle_numero'  => $this->cycle->numero_cycle,
            'montant'       => $this->tontine->montant_cotisation,
            'message'       => "⚠️ Retard : cotisation de {$this->tontine->montant_cotisation} FCFA non payée pour le cycle {$this->cycle->numero_cycle}.",
        ];
    }
}
