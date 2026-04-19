<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Invitation;
use App\Models\Tontine;
use App\Models\User;
use App\Notifications\InvitationTontineNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Support\Facades\Notification;

/**
 * @group Admin — Invitations
 * @authenticated
 *
 * Inviter des membres à rejoindre une tontine par email ou code.
 */
class InvitationController extends Controller
{
    /**
     * Envoyer une invitation
     *
     * Invite un utilisateur (existant ou nouveau) à rejoindre une tontine.
     * Un email avec un lien d'acceptation est envoyé automatiquement.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     *
     * @bodyParam email string required Email de la personne à inviter. Example: alice@example.com
     * @bodyParam message string Message personnalisé. Example: Rejoins notre groupe !
     * @bodyParam expires_in_hours integer Durée de validité en heures (défaut: 48). Example: 72
     *
     * @response 201 {
     *   "message": "Invitation envoyée à alice@example.com.",
     *   "invitation": {
     *     "id": 1, "email": "alice@example.com", "token": "abc123...",
     *     "statut": "en_attente", "expires_at": "2026-04-16T10:00:00"
     *   }
     * }
     */
    public function envoyer(Request $request, Tontine $tontine): JsonResponse
    {
        $data = $request->validate([
            'email'             => 'required|email',
            'message'           => 'nullable|string|max:500',
            'expires_in_hours'  => 'nullable|integer|min:1|max:168',
        ]);

        // Vérifier si une invitation en attente existe déjà
        $existante = Invitation::where('tontine_id', $tontine->id)
            ->where('email', $data['email'])
            ->where('statut', 'en_attente')
            ->where('expires_at', '>', now())
            ->first();

        if ($existante) {
            return response()->json([
                'message' => 'Une invitation en attente existe déjà pour cet email.',
                'invitation' => $existante,
            ], 422);
        }

        // Chercher si l'utilisateur existe déjà
        $user = User::where('email', $data['email'])->first();

        // Vérifier si déjà membre de la tontine
        if ($user && $tontine->membres()->where('users.id', $user->id)->exists()) {
            return response()->json([
                'message' => 'Cet utilisateur est déjà membre de cette tontine.',
            ], 422);
        }

        $heures = $data['expires_in_hours'] ?? 48;

        $invitation = Invitation::create([
            'tontine_id'  => $tontine->id,
            'invite_par'  => $request->user()->id,
            'user_id'     => $user?->id,
            'email'       => $data['email'],
            'token'       => Invitation::genererToken(),
            'statut'      => 'en_attente',
            'expires_at'  => now()->addHours($heures),
            'message'     => $data['message'] ?? null,
        ]);

        // Envoyer l'email
        if ($user) {
            $user->notify(new InvitationTontineNotification($invitation->load('tontine', 'invitePar')));
        } else {
            Notification::route('mail', $data['email'])
                ->notify(new InvitationTontineNotification($invitation->load('tontine', 'invitePar')));
        }

        AuditLog::journaliser('invitation.envoyee', $invitation, [
            'tontine_id'  => $tontine->id,
            'tontine_nom' => $tontine->nom,
            'email'       => $data['email'],
        ]);

        return response()->json([
            'message'     => "Invitation envoyée à {$data['email']}.",
            'invitation'  => $invitation,
        ], 201);
    }

    /**
     * Liste des invitations d'une tontine
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @queryParam statut string Filtrer par statut (en_attente|acceptee|refusee|expiree). Example: en_attente
     *
     * @response [{
     *   "id": 1, "email": "alice@example.com", "statut": "en_attente",
     *   "expires_at": "2026-04-16T10:00:00", "invite_par": "Admin Test"
     * }]
     */
    public function index(Request $request, Tontine $tontine): JsonResponse
    {
        // Marquer les expirées automatiquement
        Invitation::where('tontine_id', $tontine->id)
            ->where('statut', 'en_attente')
            ->where('expires_at', '<', now())
            ->update(['statut' => 'expiree']);

        $query = Invitation::where('tontine_id', $tontine->id)
            ->with('invitePar:id,first_name,last_name', 'user:id,first_name,last_name')
            ->latest();

        if ($request->filled('statut')) {
            $query->where('statut', $request->statut);
        }

        return response()->json($query->get()->map(fn($inv) => [
            'id'          => $inv->id,
            'email'       => $inv->email,
            'statut'      => $inv->statut,
            'expires_at'  => $inv->expires_at,
            'repondu_at'  => $inv->repondu_at,
            'message'     => $inv->message,
            'invite_par'  => $inv->invitePar->full_name,
            'membre'      => $inv->user?->full_name,
            'token'       => $inv->token,
        ]));
    }

    /**
     * Annuler une invitation
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @urlParam invitation integer required ID de l'invitation. Example: 1
     *
     * @response { "message": "Invitation annulée." }
     */
    public function annuler(Tontine $tontine, Invitation $invitation): JsonResponse
    {
        if ($invitation->tontine_id !== $tontine->id) {
            return response()->json(['message' => 'Invitation introuvable.'], 404);
        }

        if ($invitation->statut !== 'en_attente') {
            return response()->json(['message' => 'Seules les invitations en attente peuvent être annulées.'], 422);
        }

        $invitation->update(['statut' => 'expiree']);

        return response()->json(['message' => 'Invitation annulée.']);
    }
}
