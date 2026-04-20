<?php

namespace App\Http\Controllers;

use App\Models\TontineType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Types de Tontine
 *
 * Gestion des types/formules de tontine avec leurs montants.
 */
class TontineTypeController extends Controller
{
    /**
     * Liste des types
     *
     * Retourne tous les types de tontine actifs.
     *
     * @unauthenticated
     *
     * @response [{
     *   "id": 1, "nom": "Bronze", "montant": "5000.00", "devise": "FCFA",
     *   "description": "Formule de base", "actif": true
     * }]
     */
    public function index(): JsonResponse
    {
        return response()->json(TontineType::where('actif', true)->get());
    }

    /**
     * Créer un type
     *
     * Réservé aux admins.
     *
     * @authenticated
     *
     * @bodyParam nom string required Nom du type. Example: Gold
     * @bodyParam montant number required Montant de cotisation. Example: 25000
     * @bodyParam devise string Devise (défaut: FCFA). Example: FCFA
     * @bodyParam description string Description / avantages. Example: Formule premium
     * @bodyParam actif boolean Actif ou non (défaut: true). Example: true
     *
     * @response 201 { "id": 3, "nom": "Gold", "montant": "25000.00", "devise": "FCFA" }
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nom'         => 'required|string|max:100|unique:tontine_types,nom',
            'montant'     => 'required|numeric|min:0',
            'devise'      => 'sometimes|string|max:10',
            'description' => 'nullable|string',
            'actif'       => 'sometimes|boolean',
        ]);

        $type = TontineType::create($data);

        return response()->json($type, 201);
    }

    /**
     * Détail d'un type
     *
     * @unauthenticated
     *
     * @urlParam id integer required ID du type. Example: 1
     *
     * @response { "id": 1, "nom": "Bronze", "montant": "5000.00", "devise": "FCFA" }
     */
    public function show(TontineType $tontineType): JsonResponse
    {
        return response()->json($tontineType);
    }

    /**
     * Modifier un type
     *
     * Réservé aux admins.
     *
     * @authenticated
     *
     * @urlParam id integer required ID du type. Example: 1
     * @bodyParam nom string Nom du type. Example: Silver Plus
     * @bodyParam montant number Montant. Example: 15000
     * @bodyParam actif boolean Activer/désactiver. Example: false
     */
    public function update(Request $request, TontineType $tontineType): JsonResponse
    {
        $data = $request->validate([
            'nom'         => 'sometimes|string|max:100|unique:tontine_types,nom,' . $tontineType->id,
            'montant'     => 'sometimes|numeric|min:0',
            'devise'      => 'sometimes|string|max:10',
            'description' => 'nullable|string',
            'actif'       => 'sometimes|boolean',
        ]);

        $tontineType->update($data);

        return response()->json($tontineType);
    }

    /**
     * Supprimer un type
     *
     * Réservé aux admins.
     *
     * @authenticated
     *
     * @urlParam id integer required ID du type. Example: 1
     *
     * @response { "message": "Type supprimé avec succès." }
     */
    public function destroy(TontineType $tontineType): JsonResponse
    {
        $tontineType->delete();

        return response()->json(['message' => 'Type supprimé avec succès.']);
    }
}
