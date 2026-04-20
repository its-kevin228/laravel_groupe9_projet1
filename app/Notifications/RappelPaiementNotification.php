<?php

namespace App\Notifications;

use App\Models\Cycle;
use App\Models\Tontine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RappelPaiementNotification extends Notification implements ShouldQueue
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
            ->subject("⏰ Rappel de paiement — {$this->tontine->nom}")
            ->greeting("Bonjour {$notifiable->first_name},")
            ->line("Un rappel concernant votre cotisation pour la tontine **{$this->tontine->nom}**.")
            ->line("Cycle n° **{$this->cycle->numero_cycle}** — Montant dû : **{$this->tontine->montant_cotisation} {$this->tontine->devise ?? 'FCFA'}**")
            ->when($this->cycle->date_fermeture, fn($mail) =>
                $mail->line("Date limite : **{$this->cycle->date_fermeture->format('d/m/Y')}**")
            )
            ->action('Voir mon tableau de bord', config('app.url'))
            ->line('Merci de régulariser votre situation dans les meilleurs délais.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type'          => 'rappel_paiement',
            'tontine_id'    => $this->tontine->id,
            'tontine_nom'   => $this->tontine->nom,
            'cycle_id'      => $this->cycle->id,
            'cycle_numero'  => $this->cycle->numero_cycle,
            'montant'       => $this->tontine->montant_cotisation,
            'date_limite'   => $this->cycle->date_fermeture?->toDateString(),
            'message'       => "Rappel : cotisation de {$this->tontine->montant_cotisation} FCFA due pour le cycle {$this->cycle->numero_cycle}.",
        ];
    }
}
