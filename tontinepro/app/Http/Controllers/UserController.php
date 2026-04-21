<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Affiche la liste de tous les utilisateurs et leurs tontines.
     */
    public function index(): View
    {
        // On charge les utilisateurs avec leurs tontines
        $users = User::with('tontines')->orderBy('name')->paginate(10);
        
        return view('users.index', compact('users'));
    }

    /**
     * Alterne le rôle entre 'member' et 'admin'.
     */
    public function toggleRole(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas modifier votre propre rôle.');
        }

        $user->role = $user->role === 'admin' ? 'member' : 'admin';
        $user->save();

        $status = $user->role === 'admin' ? 'Promu au rôle d\'Administrateur' : 'Rétrogradé au rôle de Membre';

        return back()->with('success', "{$user->name} a été {$status}.");
    }

    /**
     * Alterne le statut de bannissement.
     */
    public function toggleBan(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Vous ne pouvez pas vous bannir vous-même.');
        }

        // Si tu as un champ status dans 'users'
        // Pour l'instant, si le champ n'existe pas, on simule l'erreur.
        // Je vais vérifier tes migrations pour confirmer.
        return back()->with('error', 'La fonctionnalité de bannissement sera activée après la mise à jour de la base de données.');
    }
}
