<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /** Admin voit tous les membres, membre voit uniquement son profil */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /** Admin voit tout profil, membre voit uniquement le sien */
    public function view(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->id === $model->id;
    }

    /** Seul l'admin peut modifier un autre utilisateur */
    public function update(User $user, User $model): bool
    {
        return $user->isAdmin() || $user->id === $model->id;
    }

    /** Seul l'admin peut exclure un membre */
    public function exclure(User $user, User $model): bool
    {
        // Ne peut pas s'exclure soi-même, ne peut pas exclure un admin
        return $user->isAdmin()
            && $user->id !== $model->id
            && $model->isMembre();
    }

    /** Seul l'admin peut réintégrer un membre exclu */
    public function reintegrer(User $user, User $model): bool
    {
        return $user->isAdmin() && ! is_null($model->exclu_at);
    }
}
