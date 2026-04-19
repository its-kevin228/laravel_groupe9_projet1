<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Rappels de paiement : chaque jour à 8h
Schedule::command('tontine:notifier --type=rappel --jours=3')
    ->dailyAt('08:00')
    ->description('Rappels de paiement 3 jours avant échéance');

// Alertes retard : chaque jour à 9h
Schedule::command('tontine:notifier --type=retard')
    ->dailyAt('09:00')
    ->description('Alertes retard de paiement');

// Planification automatique des cycles : chaque jour à 7h
Schedule::command('tontine:planifier-cycles')
    ->dailyAt('07:00')
    ->description('Ferme les cycles échus et ouvre automatiquement les suivants');
