<?php

use App\Http\Controllers\Admin\AdminMembreController;
use App\Http\Controllers\Admin\CycleController;
use App\Http\Controllers\Admin\ExclusionMembreController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\HistoriqueController;
use App\Http\Controllers\Admin\InvitationController;
use App\Http\Controllers\Admin\MembreTontineTypeController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\StatsDashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InvitationReponseController;
use App\Http\Controllers\Membre\DashboardController;
use App\Http\Controllers\TontineTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes publiques — Auth
|--------------------------------------------------------------------------
*/
Route::prefix('auth')->group(function () {
    Route::get('register-form', [AuthController::class, 'registerForm']); // données pour le formulaire
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);
});

// Types de tontine (lecture publique)
Route::get('tontine-types',       [TontineTypeController::class, 'index']);
Route::get('tontine-types/{tontineType}', [TontineTypeController::class, 'show']);

// Invitations — réponse publique (via token email)
Route::get('invitations/{token}',           [InvitationReponseController::class, 'consulter']);
Route::post('invitations/{token}/accepter', [InvitationReponseController::class, 'accepter']);
Route::post('invitations/{token}/refuser',  [InvitationReponseController::class, 'refuser']);

/*
|--------------------------------------------------------------------------
| Routes protégées — utilisateur connecté
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {

    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me',      [AuthController::class, 'me']);

    /*
    |----------------------------------------------------------------------
    | Routes réservées aux admins
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        // Dashboard statistiques admin
        Route::get('stats',                         [StatsDashboardController::class, 'global']);
        Route::get('stats/tontines/{tontine}',      [StatsDashboardController::class, 'parTontine']);

        // Historique & Audit
        Route::get('historique/paiements',          [HistoriqueController::class, 'paiements']);
        Route::get('historique/beneficiaires',      [HistoriqueController::class, 'beneficiaires']);
        Route::get('historique/journal',            [HistoriqueController::class, 'journal']);
        Route::get('historique/actions',            [HistoriqueController::class, 'actionsDisponibles']);

        Route::get('membres', [AdminMembreController::class, 'index']);

        // Exclusion de membres
        Route::get('membres/exclus',                    [ExclusionMembreController::class, 'exclus']);
        Route::post('membres/{user}/exclure',           [ExclusionMembreController::class, 'exclure']);
        Route::post('membres/{user}/reintegrer',        [ExclusionMembreController::class, 'reintegrer']);

        // Types de tontine par membre
        Route::get('membres/{user}/tontine-types',                          [MembreTontineTypeController::class, 'index']);
        Route::post('membres/{user}/tontine-types',                         [MembreTontineTypeController::class, 'store']);
        Route::delete('membres/{user}/tontine-types/{tontineType}',         [MembreTontineTypeController::class, 'destroy']);

        Route::post('tontine-types',                    [TontineTypeController::class, 'store']);
        Route::put('tontine-types/{tontineType}',       [TontineTypeController::class, 'update']);
        Route::delete('tontine-types/{tontineType}',    [TontineTypeController::class, 'destroy']);

        // Cycles
        Route::get('tontines/{tontine}/cycles',                     [CycleController::class, 'index']);
        Route::post('tontines/{tontine}/cycles',                    [CycleController::class, 'store']);
        Route::get('tontines/{tontine}/cycles/{cycle}',             [CycleController::class, 'show']);
        Route::post('tontines/{tontine}/cycles/{cycle}/fermer',     [CycleController::class, 'fermer']);

        // Paiements
        Route::get('tontines/{tontine}/cycles/{cycle}/paiements',                      [PaymentController::class, 'index']);
        Route::post('tontines/{tontine}/cycles/{cycle}/paiements',                     [PaymentController::class, 'store']);
        Route::get('tontines/{tontine}/cycles/{cycle}/paiements/membres/{user}',       [PaymentController::class, 'statutMembre']);

        // Notifications manuelles
        Route::post('tontines/{tontine}/cycles/{cycle}/notifier/rappel',        [NotificationController::class, 'rappel']);
        Route::post('tontines/{tontine}/cycles/{cycle}/notifier/retard',        [NotificationController::class, 'retard']);
        Route::post('tontines/{tontine}/cycles/{cycle}/notifier/beneficiaire',  [NotificationController::class, 'beneficiaire']);

        // Invitations
        Route::get('tontines/{tontine}/invitations',                [InvitationController::class, 'index']);
        Route::post('tontines/{tontine}/invitations',               [InvitationController::class, 'envoyer']);
        Route::delete('tontines/{tontine}/invitations/{invitation}',[InvitationController::class, 'annuler']);

        // Export PDF
        Route::get('tontines/{tontine}/export/membres',     [ExportController::class, 'membres']);
        Route::get('tontines/{tontine}/export/paiements',   [ExportController::class, 'paiements']);
        Route::get('tontines/{tontine}/export/historique',  [ExportController::class, 'historique']);
    });

    /*
    |----------------------------------------------------------------------
    | Routes accessibles aux membres (et admins)
    |----------------------------------------------------------------------
    */
    Route::middleware('role:admin,membre')->group(function () {
        // Tableau de bord membre
        Route::get('dashboard',                                 [DashboardController::class, 'index']);
        Route::get('dashboard/tontines/{tontine}',             [DashboardController::class, 'tontine']);
        Route::get('dashboard/tontines/{tontine}/historique',  [DashboardController::class, 'historique']);

        // Notifications du membre connecté
        Route::get('notifications',                     [NotificationController::class, 'mesNotifications']);
        Route::patch('notifications/{id}/lue',          [NotificationController::class, 'marquerLue']);
        Route::patch('notifications/toutes-lues',       [NotificationController::class, 'marquerToutesLues']);
    });
});
