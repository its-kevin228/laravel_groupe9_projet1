<?php

namespace App\Policies;

use App\Models\Tontine;
use App\Models\User;

class TontinePolicy
{
    /** Seul l'admin peut voir la liste complète des tontines */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /** Admin voit tout, membre voit uniquement ses tontines */
    public function view(User $user, Tontine $tontine): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        // Membre : doit appartenir à la tontine
        return $tontine->membres()->where('users.id', $user->id)->exists();
    }

    /** Seul l'admin peut créer une tontine */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /** Seul l'admin peut modifier, et seulement si statut modifiable */
    public function update(User $user, Tontine $tontine): bool
    {
        return $user->isAdmin() && $tontine->peutEtreModifiee();
    }

    /** Seul l'admin peut supprimer, et seulement si terminee */
    public function delete(User $user, Tontine $tontine): bool
    {
        return $user->isAdmin() && $tontine->peutEtreSupprimee();
    }

    /** Seul l'admin peut gérer les membres d'une tontine */
    public function gererMembres(User $user, Tontine $tontine): bool
    {
        return $user->isAdmin();
    }
}
