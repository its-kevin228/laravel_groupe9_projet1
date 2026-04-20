<?php

namespace App\Policies;

use App\Models\Tontine;
use App\Models\User;

class TontinePolicy
{
    /**
     * Seuls les admins peuvent créer une tontine.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Seuls les admins peuvent modifier une tontine.
     */
    public function update(User $user, Tontine $tontine): bool
    {
        return $user->isAdmin();
    }

    /**
     * Seuls les admins peuvent supprimer une tontine.
     */
    public function delete(User $user, Tontine $tontine): bool
    {
        return $user->isAdmin();
    }

    /**
     * Tous les membres authentifiés peuvent voir les tontines.
     */
    public function view(User $user, Tontine $tontine): bool
    {
        return true;
    }

    /**
     * Tous les membres authentifiés peuvent lister les tontines.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }
}
