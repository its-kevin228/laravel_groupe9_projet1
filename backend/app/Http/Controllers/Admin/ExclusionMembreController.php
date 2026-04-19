<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Admin — Exclusion de membres
 * @authenticated
 *
 * Exclure ou réintégrer un membre de la plateforme.
 */
class ExclusionMembreController extends Controller
{
    /**
     * Exclure un membre
     *
     * Bloque l'accès d'un membre à la plateforme.
     * Un membre exclu ne peut plus effectuer aucune action.
     *
     * @urlParam user integer required ID du membre à exclure. Example: 3
     * @bodyParam raison string Raison de l'exclusion. Example: Non-paiement répété
     *
     * @response {
     *   "message": "Alice Dupont a été exclu(e) avec succès.",
     *   "membre": { "id": 3, "nom_complet": "Alice Dupont", "exclu_at": "2026-04-14" }
     * }
     */
    public function exclure(Request $request, User $user): JsonResponse
    {
        $this->authorize('exclure', $user);

        if (! is_null($user->exclu_at)) {
            return response()->json(['message' => 'Ce membre est déjà exclu.'], 422);
        }

        $request->validate([
            'raison' => 'nullable|string|max:500',
        ]);

        $user->update([
            'exclu_at'         => now(),
            'raison_exclusion' => $request->raison,
        ]);

        AuditLog::journaliser('membre.exclu', $user, [
            'membre_id'  => $user->id,
            'membre_nom' => $user->full_name,
            'raison'     => $request->raison,
        ]);

        return response()->json([
            'message' => "{$user->full_name} a été exclu(e) avec succès.",
            'membre'  => [
                'id'          => $user->id,
                'nom_complet' => $user->full_name,
                'exclu_at'    => $user->exclu_at,
                'raison'      => $user->raison_exclusion,
            ],
        ]);
    }

    /**
     * Réintégrer un membre exclu
     *
     * Restaure l'accès d'un membre précédemment exclu.
     *
     * @urlParam user integer required ID du membre à réintégrer. Example: 3
     *
     * @response {
     *   "message": "Alice Dupont a été réintégré(e) avec succès.",
     *   "membre": { "id": 3, "nom_complet": "Alice Dupont", "exclu_at": null }
     * }
     */
    public function reintegrer(Request $request, User $user): JsonResponse
    {
        $this->authorize('reintegrer', $user);

        $user->update([
            'exclu_at'         => null,
            'raison_exclusion' => null,
        ]);

        AuditLog::journaliser('membre.reintegre', $user, [
            'membre_id'  => $user->id,
            'membre_nom' => $user->full_name,
        ]);

        return response()->json([
            'message' => "{$user->full_name} a été réintégré(e) avec succès.",
            'membre'  => [
                'id'          => $user->id,
                'nom_complet' => $user->full_name,
                'exclu_at'    => null,
            ],
        ]);
    }

    /**
     * Liste des membres exclus
     *
     * @response [{
     *   "id": 3, "nom_complet": "Alice Dupont", "phone": "+22890000000",
     *   "exclu_at": "2026-04-14", "raison_exclusion": "Non-paiement répété"
     * }]
     */
    public function exclus(): JsonResponse
    {
        $exclus = User::where('role', 'membre')
            ->whereNotNull('exclu_at')
            ->get()
            ->map(fn($u) => [
                'id'               => $u->id,
                'nom_complet'      => $u->full_name,
                'email'            => $u->email,
                'phone'            => $u->phone,
                'exclu_at'         => $u->exclu_at,
                'raison_exclusion' => $u->raison_exclusion,
            ]);

        return response()->json($exclus);
    }
}
