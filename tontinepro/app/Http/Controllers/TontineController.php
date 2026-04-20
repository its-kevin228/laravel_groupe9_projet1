<?php

namespace App\Http\Controllers;

use App\Models\Tontine;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TontineController extends Controller
{
    /**
     * Affiche le formulaire de création d'une tontine.
     * Réservé aux administrateurs via TontinePolicy.
     */
    public function create(): View
    {
        $this->authorize('create', Tontine::class);

        // Récupérer tous les membres pour les ajouter à la tontine
        $members = User::where('role', 'member')->orderBy('name')->get();

        return view('tontines.create', compact('members'));
    }

    /**
     * Enregistre une nouvelle tontine et ses membres dans la table pivot.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Tontine::class);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'amount_per_cycle' => ['required', 'numeric', 'min:1'],
            'frequency' => ['required', 'string', 'in:hebdomadaire,mensuel,bimestriel,trimestriel'],
            'members' => ['nullable', 'array'],
            'members.*' => ['exists:users,id'],
        ]);

        // Création de la tontine
        $tontine = Tontine::create([
            'name' => $validated['name'],
            'amount_per_cycle' => $validated['amount_per_cycle'],
            'frequency' => $validated['frequency'],
            'status' => 'active',
        ]);

        // Ajout des membres dans la table pivot avec leur beneficiary_order
        if (!empty($validated['members'])) {
            $pivotData = [];

            foreach ($validated['members'] as $order => $userId) {
                $pivotData[$userId] = [
                    'beneficiary_order' => $order + 1, // ordre commence à 1
                    'joined_at' => now(),
                ];
            }

            $tontine->members()->attach($pivotData);
        }

        return redirect()
            ->route('tontines.show', $tontine)
            ->with('success', "La tontine \"{$tontine->name}\" a été créée avec succès.");
    }

    /**
     * Affiche les détails d'une tontine.
     */
    public function show(Tontine $tontine): View
    {
        $this->authorize('view', $tontine);

        $tontine->load(['members', 'cycles.beneficiary', 'cycles.payments']);

        $activeCycle = $tontine->cycles->whereNull('closed_at')->sortByDesc('cycle_number')->first();
        $closedCycles = $tontine->cycles->whereNotNull('closed_at')->sortByDesc('cycle_number');

        return view('tontines.show', compact('tontine', 'activeCycle', 'closedCycles'));
    }

    /**
     * Liste toutes les tontines.
     */
    public function index(): View
    {
        $this->authorize('viewAny', Tontine::class);

        $tontines = Tontine::withCount('members')->latest()->paginate(10);

        return view('tontines.index', compact('tontines'));
    }

    /**
     * Affiche le formulaire d'édition.
     */
    public function edit(Tontine $tontine): View
    {
        $this->authorize('update', $tontine);

        $members = User::where('role', 'member')->orderBy('name')->get();
        $selectedMemberIds = $tontine->members()->pluck('users.id')->toArray();

        return view('tontines.edit', compact('tontine', 'members', 'selectedMemberIds'));
    }

    /**
     * Met à jour la tontine et l'ordre des membres.
     */
    public function update(Request $request, Tontine $tontine): RedirectResponse
    {
        $this->authorize('update', $tontine);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'amount_per_cycle' => ['required', 'numeric', 'min:1'],
            'frequency' => ['required', 'string', 'in:hebdomadaire,mensuel,bimestriel,trimestriel'],
            'status' => ['required', 'string', 'in:active,clôturée'],
            'members' => ['nullable', 'array'],
            'members.*' => ['exists:users,id'],
        ]);

        $tontine->update([
            'name' => $validated['name'],
            'amount_per_cycle' => $validated['amount_per_cycle'],
            'frequency' => $validated['frequency'],
            'status' => $validated['status'],
        ]);

        // Mise à jour des membres (sync)
        if (isset($validated['members'])) {
            $pivotData = [];
            foreach ($validated['members'] as $order => $userId) {
                $pivotData[$userId] = [
                    'beneficiary_order' => $order + 1,
                    // On garde le joined_at existant si possible, sinon now()
                    'joined_at' => $tontine->members()->find($userId)?->pivot->joined_at ?? now(),
                ];
            }
            $tontine->members()->sync($pivotData);
        } else {
            $tontine->members()->detach();
        }

        return redirect()
            ->route('tontines.show', $tontine)
            ->with('success', "La tontine \"{$tontine->name}\" a été mise à jour.");
    }

    /**
     * Supprime la tontine.
     */
    public function destroy(Tontine $tontine): RedirectResponse
    {
        $this->authorize('delete', $tontine);

        $tontine->delete();

        return redirect()
            ->route('tontines.index')
            ->with('success', "La tontine a été supprimée.");
    }
}
