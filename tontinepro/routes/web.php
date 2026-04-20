<?php

use App\Http\Controllers\CycleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TontineController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard (admin ou membre selon le rôle)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profil Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tontines (lecture pour tous, création/gestion réservée aux admins via TontinePolicy)
    Route::resource('tontines', TontineController::class);

    // Cycles imbriqués dans les tontines
    Route::prefix('tontines/{tontine}/cycles')->name('tontines.cycles.')->group(function () {
        Route::post('/', [CycleController::class, 'store'])->name('store');
        Route::patch('/{cycle}/close', [CycleController::class, 'close'])->name('close');

        // Paiements imbriqués dans les cycles
        Route::post('/{cycle}/payments', [PaymentController::class, 'store'])
            ->name('payments.store');
    });
});

require __DIR__ . '/auth.php';
