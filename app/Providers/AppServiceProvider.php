<?php

namespace App\Providers;

use App\Models\Cycle;
use App\Models\Tontine;
use App\Models\User;
use App\Policies\CyclePolicy;
use App\Policies\TontinePolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Policies
        Gate::policy(Tontine::class, TontinePolicy::class);
        Gate::policy(Cycle::class,   CyclePolicy::class);
        Gate::policy(User::class,    UserPolicy::class);

        // Gates globaux
        Gate::define('admin', fn(User $user) => $user->isAdmin());
        Gate::define('membre', fn(User $user) => $user->isMembre());
        Gate::define('non-exclu', fn(User $user) => is_null($user->exclu_at));

        // Bloquer les membres exclus sur toutes les requêtes authentifiées
        Gate::before(function (User $user, string $ability) {
            // Un membre exclu ne peut rien faire sauf voir son profil
            if (! is_null($user->exclu_at) && $ability !== 'view') {
                return false;
            }
        });
    }
}
