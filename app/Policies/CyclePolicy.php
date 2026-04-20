<?php

namespace App\Policies;

use App\Models\Cycle;
use App\Models\Tontine;
use App\Models\User;

class CyclePolicy
{
    /** Seul l'admin peut créer un cycle */
    public function create(User $user, Tontine $tontine): bool
    {
        return $user->isAdmin();
    }

    /** Admin voit tout, membre voit les cycles de ses tontines */
    public function view(User $user, Cycle $cycle): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $cycle->tontine->membres()->where('users.id', $user->id)->exists();
    }

    /** Seul l'admin peut fermer un cycle */
    public function fermer(User $user, Cycle $cycle): bool
    {
        return $user->isAdmin() && $cycle->estOuvert();
    }

    /** Seul l'admin peut enregistrer un paiement */
    public function enregistrerPaiement(User $user, Cycle $cycle): bool
    {
        return $user->isAdmin() && $cycle->estOuvert();
    }
}
