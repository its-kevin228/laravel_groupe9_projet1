<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Invitation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Invitations — Réponse
 *
 * Accepter ou refuser une invitation à une tontine via le token reçu par email.
 */
class InvitationReponseController extends Controller
{
    /**
     * Consulter une invitation
     *
     * Retourne les détails d'une invitation à partir de son token.
     *
     * @urlParam token string required Token de l'invitation. Example: abc123xyz
     *
     * @response {
     *   "tontine": { "nom": "Tontine Solidarité", "montant_cotisation": "5000.00" },
     *   "invite_par": "Admin Test",
     *   "email": "alice@example.com",
     *   "statut": "en_attente",
     *   "expires_at": "2026-04-16T10:00:00",
     *   "message": "Rejoins notre groupe !"
     * }
     */
    public function consulter(string $token): JsonResponse
    {
        $invitation = Invitation::where('token', $token)
            ->with('tontine:id,nom,montant_cotisation,frequence', 'invitePar:id,first_name,last_name')
            ->firstOrFail();

        // Marquer comme expirée si nécessaire
        if ($invitation->estExpiree()) {
            $invitation->update(['statut' => 'expiree']);
        }

        return response()->json([
            'tontine'    => $invitation->tontine->only(['id', 'nom', 'montant_cotisation', 'frequence']),
            'invite_par' => $invitation->invitePar->full_name,
            'email'      => $invitation->email,
            'statut'     => $invitation->statut,
            'expires_at' => $invitation->expires_at,
            'message'    => $invitation->message,
            'valide'     => $invitation->estValide(),
        ]);
    }

    /**
     * Accepter une invitation
     *
     * Accepte l'invitation. Si l'utilisateur n'existe pas encore,
     * il doit s'inscrire d'abord puis rappeler cet endpoint avec son token auth.
     *
     * @urlParam token string required Token de l'invitation. Example: abc123xyz
     *
     * @response {
     *   "message": "Invitation acceptée. Vous êtes maintenant membre de Tontine Solidarité.",
     *   "tontine": { "id": 1, "nom": "Tontine Solidarité" }
     * }
     */
    public function accepter(Request $request, string $token): JsonResponse
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        if (! $invitation->estValide()) {
            return response()->json([
                'message' => match ($invitation->statut) {
                    'acceptee' => 'Cette invitation a déjà été acceptée.',
                    'refusee'  => 'Cette invitation a été refusée.',
                    default    => 'Cette invitation a expiré.',
                },
            ], 422);
        }

        // Identifier l'utilisateur : connecté ou via email
        $user = $request->user()
            ?? \App\Models\User::where('email', $invitation->email)->first();

        if (! $user) {
            return response()->json([
                'message' => 'Vous devez créer un compte avec l\'email ' . $invitation->email . ' avant d\'accepter cette invitation.',
                'action'  => 'register',
                'email'   => $invitation->email,
            ], 403);
        }

        if ($user->email !== $invitation->email) {
            return response()->json([
                'message' => 'Cette invitation est destinée à ' . $invitation->email . '.',
            ], 403);
        }

        $tontine = $invitation->tontine;

        // Vérifier si déjà membre
        if ($tontine->membres()->where('users.id', $user->id)->exists()) {
            $invitation->update(['statut' => 'acceptee', 'repondu_at' => now(), 'user_id' => $user->id]);
            return response()->json(['message' => 'Vous êtes déjà membre de cette tontine.'], 422);
        }

        // Assigner le membre à la tontine
        $user->update(['tontine_id' => $tontine->id]);

        $invitation->update([
            'statut'     => 'acceptee',
            'repondu_at' => now(),
            'user_id'    => $user->id,
        ]);

        AuditLog::journaliser('invitation.acceptee', $invitation, [
            'tontine_id'  => $tontine->id,
            'tontine_nom' => $tontine->nom,
            'user_id'     => $user->id,
            'email'       => $user->email,
        ], $user->id);

        return response()->json([
            'message' => "Invitation acceptée. Vous êtes maintenant membre de {$tontine->nom}.",
            'tontine' => $tontine->only(['id', 'nom', 'montant_cotisation', 'frequence']),
        ]);
    }

    /**
     * Refuser une invitation
     *
     * @urlParam token string required Token de l'invitation. Example: abc123xyz
     *
     * @response { "message": "Invitation refusée." }
     */
    public function refuser(string $token): JsonResponse
    {
        $invitation = Invitation::where('token', $token)->firstOrFail();

        if (! $invitation->estValide()) {
            return response()->json(['message' => 'Cette invitation n\'est plus valide.'], 422);
        }

        $invitation->update([
            'statut'     => 'refusee',
            'repondu_at' => now(),
        ]);

        AuditLog::journaliser('invitation.refusee', $invitation, [
            'tontine_id'  => $invitation->tontine_id,
            'email'       => $invitation->email,
        ]);

        return response()->json(['message' => 'Invitation refusée.']);
    }
}
