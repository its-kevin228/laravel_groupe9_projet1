<?php

namespace App\Policies;

use App\Models\Payment;
use App\Models\User;

class PaymentPolicy
{
    /**
     * Seul l'admin peut enregistrer un paiement.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Seul l'admin peut voir les paiements d'un cycle.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }
}
