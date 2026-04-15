<?php

namespace App\Notifications;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationTontineNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly Invitation $invitation,
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $tontine    = $this->invitation->tontine;
        $invitePar  = $this->invitation->invitePar;
        $expireDate = $this->invitation->expires_at->format('d/m/Y à H:i');

        // URLs d'acceptation et de refus (à adapter selon le frontend)
        $urlAccepter = config('app.url') . '/api/invitations/' . $this->invitation->token . '/accepter';
        $urlRefuser  = config('app.url') . '/api/invitations/' . $this->invitation->token . '/refuser';

        $mail = (new MailMessage)
            ->subject("🤝 Invitation à rejoindre la tontine — {$tontine->nom}")
            ->greeting("Bonjour,")
            ->line("{$invitePar->full_name} vous invite à rejoindre la tontine **{$tontine->nom}**.")
            ->line("Montant de cotisation : **{$tontine->montant_cotisation} FCFA** ({$tontine->frequence})");

        if ($this->invitation->message) {
            $mail->line("Message : *{$this->invitation->message}*");
        }

        $mail->line("Cette invitation expire le **{$expireDate}**.")
            ->action('✅ Accepter l\'invitation', $urlAccepter)
            ->line("Ou refuser : {$urlRefuser}")
            ->line("Si vous n'attendiez pas cette invitation, ignorez simplement cet email.");

        return $mail;
    }
}
