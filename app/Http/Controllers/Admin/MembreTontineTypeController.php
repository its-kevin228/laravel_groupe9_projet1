<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TontineType;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Admin — Types de Tontine par Membre
 * @authenticated
 *
 * Gestion de l'assignation des types de tontine aux membres.
 */
class MembreTontineTypeController extends Controller
{
    /**
     * Types d'un membre
     *
     * Retourne tous les types de tontine auxquels un membre est inscrit.
     *
     * @urlParam user integer required ID du membre. Example: 1
     *
     * @response [{
     *   "id": 1, "nom": "Bronze", "montant": "5000.00", "devise": "FCFA",
     *   "pivot": { "date_adhesion": "2026-01-15", "ajoute_par": 2 }
     * }]
     */
    public function index(User $user): JsonResponse
    {
        return response()->json(
            $user->tontineTypes()->get()
        );
    }

    /**
     * Assigner un type à un membre
     *
     * Inscrit un membre à un ou plusieurs types de tontine.
     *
     * @urlParam user integer required ID du membre. Example: 1
     *
     * @bodyParam tontine_type_ids array required Liste des IDs de types à assigner. Example: [1, 2]
     * @bodyParam tontine_type_ids[] integer required ID d'un type de tontine. Example: 1
     * @bodyParam date_adhesion string Date d'adhésion (YYYY-MM-DD). Example: 2026-01-15
     *
     * @response {
     *   "message": "Types assignés avec succès.",
     *   "types": [{ "id": 1, "nom": "Bronze" }, { "id": 2, "nom": "Silver" }]
     * }
     */
    public function store(Request $request, User $user): JsonResponse
    {
        $data = $request->validate([
            'tontine_type_ids'   => 'required|array|min:1',
            'tontine_type_ids.*' => 'integer|exists:tontine_types,id',
            'date_adhesion'      => 'nullable|date',
        ]);

        $dateAdhesion = $data['date_adhesion'] ?? now()->toDateString();
        $adminId      = $request->user()->id;

        // Vérifier les doublons
        $dejaInscrits = $user->tontineTypes()
            ->whereIn('tontine_types.id', $data['tontine_type_ids'])
            ->pluck('tontine_types.id')
            ->toArray();

        if (! empty($dejaInscrits)) {
            $noms = TontineType::whereIn('id', $dejaInscrits)->pluck('nom')->join(', ');
            return response()->json([
                'message' => "Le membre est déjà inscrit aux types : {$noms}.",
            ], 422);
        }

        // Préparer les données pivot
        $pivot = [];
        foreach ($data['tontine_type_ids'] as $typeId) {
            $pivot[$typeId] = [
                'date_adhesion' => $dateAdhesion,
                'ajoute_par'    => $adminId,
            ];
        }

        $user->tontineTypes()->attach($pivot);

        return response()->json([
            'message' => 'Types assignés avec succès.',
            'types'   => $user->tontineTypes()->get(),
        ]);
    }

    /**
     * Retirer un type d'un membre
     *
     * Supprime l'inscription d'un membre à un type de tontine spécifique.
     *
     * @urlParam user integer required ID du membre. Example: 1
     * @urlParam tontineType integer required ID du type à retirer. Example: 1
     *
     * @response { "message": "Type retiré avec succès." }
     */
    public function destroy(User $user, TontineType $tontineType): JsonResponse
    {
        $inscrit = $user->tontineTypes()->where('tontine_types.id', $tontineType->id)->exists();

        if (! $inscrit) {
            return response()->json([
                'message' => "Ce membre n'est pas inscrit à ce type de tontine.",
            ], 422);
        }

        $user->tontineTypes()->detach($tontineType->id);

        return response()->json(['message' => 'Type retiré avec succès.']);
    }
}
