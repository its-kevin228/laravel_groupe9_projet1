<?php

namespace App\Notifications;

use App\Models\Cycle;
use App\Models\Tontine;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BeneficiaireNotification extends Notification implements ShouldQueue
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
        $totalMembres = $this->tontine->membres()->count();
        $cagnotte     = $totalMembres * (float) $this->tontine->montant_cotisation;

        return (new MailMessage)
            ->subject("🎉 Vous êtes le bénéficiaire — {$this->tontine->nom}")
            ->greeting("Félicitations {$notifiable->first_name} !")
            ->line("Vous êtes le **bénéficiaire du cycle n° {$this->cycle->numero_cycle}** de la tontine **{$this->tontine->nom}**.")
            ->line("Cagnotte estimée : **{$cagnotte} FCFA** ({$totalMembres} membres × {$this->tontine->montant_cotisation} FCFA)")
            ->line("Date d'ouverture du cycle : **{$this->cycle->date_ouverture->format('d/m/Y')}**")
            ->action('Voir les détails', config('app.url'))
            ->line('Votre organisateur vous contactera pour le versement.');
    }

    public function toArray(object $notifiable): array
    {
        $cagnotte = $this->tontine->membres()->count() * (float) $this->tontine->montant_cotisation;

        return [
            'type'          => 'beneficiaire',
            'tontine_id'    => $this->tontine->id,
            'tontine_nom'   => $this->tontine->nom,
            'cycle_id'      => $this->cycle->id,
            'cycle_numero'  => $this->cycle->numero_cycle,
            'cagnotte'      => $cagnotte,
            'message'       => "🎉 Vous êtes le bénéficiaire du cycle {$this->cycle->numero_cycle} — cagnotte : {$cagnotte} FCFA.",
        ];
    }
}
