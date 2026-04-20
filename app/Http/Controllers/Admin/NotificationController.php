<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\EnvoyerAlerteRetard;
use App\Jobs\EnvoyerRappelPaiement;
use App\Jobs\NotifierBeneficiaire;
use App\Models\Cycle;
use App\Models\Tontine;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Admin — Notifications
 * @authenticated
 *
 * Déclenchement manuel des notifications de paiement.
 */
class NotificationController extends Controller
{
    /**
     * Envoyer un rappel de paiement
     *
     * Dispatche un rappel à tous les membres n'ayant pas encore payé le cycle actif.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @urlParam cycle integer required ID du cycle. Example: 1
     *
     * @response { "message": "Rappel de paiement envoyé en queue pour le cycle 2." }
     */
    public function rappel(Tontine $tontine, Cycle $cycle): JsonResponse
    {
        if ($cycle->tontine_id !== $tontine->id) {
            return response()->json(['message' => 'Cycle introuvable pour cette tontine.'], 404);
        }

        EnvoyerRappelPaiement::dispatch($tontine, $cycle);

        return response()->json([
            'message' => "Rappel de paiement envoyé en queue pour le cycle {$cycle->numero_cycle}.",
        ]);
    }

    /**
     * Envoyer une alerte de retard
     *
     * Dispatche une alerte aux membres en retard de paiement.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @urlParam cycle integer required ID du cycle. Example: 1
     *
     * @response { "message": "Alerte retard envoyée en queue pour le cycle 2." }
     */
    public function retard(Tontine $tontine, Cycle $cycle): JsonResponse
    {
        if ($cycle->tontine_id !== $tontine->id) {
            return response()->json(['message' => 'Cycle introuvable pour cette tontine.'], 404);
        }

        EnvoyerAlerteRetard::dispatch($tontine, $cycle);

        return response()->json([
            'message' => "Alerte retard envoyée en queue pour le cycle {$cycle->numero_cycle}.",
        ]);
    }

    /**
     * Notifier le bénéficiaire
     *
     * Envoie une notification au bénéficiaire du cycle actif.
     *
     * @urlParam tontine integer required ID de la tontine. Example: 1
     * @urlParam cycle integer required ID du cycle. Example: 1
     *
     * @response { "message": "Notification envoyée au bénéficiaire Alice Dupont." }
     */
    public function beneficiaire(Tontine $tontine, Cycle $cycle): JsonResponse
    {
        if ($cycle->tontine_id !== $tontine->id) {
            return response()->json(['message' => 'Cycle introuvable pour cette tontine.'], 404);
        }

        if (! $cycle->beneficiaire_id) {
            return response()->json(['message' => 'Aucun bénéficiaire défini pour ce cycle.'], 422);
        }

        NotifierBeneficiaire::dispatch($tontine, $cycle->load('beneficiaire'));

        return response()->json([
            'message' => "Notification envoyée au bénéficiaire {$cycle->beneficiaire->full_name}.",
        ]);
    }

    /**
     * Notifications reçues par le membre connecté
     *
     * Retourne les notifications en base de données du membre authentifié.
     *
     * @response {
     *   "non_lues": 2,
     *   "notifications": [
     *     { "id": "uuid", "type": "rappel_paiement", "message": "...", "created_at": "..." }
     *   ]
     * }
     */
    public function mesNotifications(Request $request): JsonResponse
    {
        $user = $request->user();

        $notifications = $user->notifications()
            ->latest()
            ->take(50)
            ->get()
            ->map(fn($n) => [
                'id'         => $n->id,
                'lu'         => ! is_null($n->read_at),
                'data'       => $n->data,
                'created_at' => $n->created_at,
            ]);

        return response()->json([
            'non_lues'      => $user->unreadNotifications()->count(),
            'notifications' => $notifications,
        ]);
    }

    /**
     * Marquer une notification comme lue
     *
     * @urlParam id string required UUID de la notification. Example: 550e8400-e29b-41d4-a716-446655440000
     *
     * @response { "message": "Notification marquée comme lue." }
     */
    public function marquerLue(Request $request, string $id): JsonResponse
    {
        $notification = $request->user()->notifications()->find($id);

        if (! $notification) {
            return response()->json(['message' => 'Notification introuvable.'], 404);
        }

        $notification->markAsRead();

        return response()->json(['message' => 'Notification marquée comme lue.']);
    }

    /**
     * Marquer toutes les notifications comme lues
     *
     * @response { "message": "Toutes les notifications ont été marquées comme lues." }
     */
    public function marquerToutesLues(Request $request): JsonResponse
    {
        $request->user()->unreadNotifications->markAsRead();

        return response()->json(['message' => 'Toutes les notifications ont été marquées comme lues.']);
    }
}
