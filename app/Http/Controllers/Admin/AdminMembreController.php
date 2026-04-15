<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Admin — Membres
 * @authenticated
 */
class AdminMembreController extends Controller
{
    /**
     * Liste des membres
     *
     * Retourne la liste paginée des membres avec leur statut de paiement
     * et le montant total cotisé estimé.
     *
     * @response 200 {
     *   "data": [
     *     {
     *       "nom_complet": "Jean Dupont",
     *       "phone": "+33600000000",
     *       "email": "jean@example.com",
     *       "statut_paiement": "payé",
     *       "type_tontine": "Tontine Mensuelle",
     *       "montant_total_cotise": "150.00",
     *       "ordre_passage": 1
     *     }
     *   ],
     *   "current_page": 1,
     *   "per_page": 15,
     *   "total": 1
     * }
     */
    public function index(Request $request): JsonResponse
    {
        $membres = User::where('role', 'membre')
            ->with(['tontine', 'tontineType'])
            ->paginate(15);

        $data = $membres->getCollection()->map(function (User $user) {
            return [
                'nom_complet'           => $user->full_name,
                'phone'                 => $user->phone,
                'email'                 => $user->email,
                'statut_paiement'       => $this->calculerStatutPaiement($user),
                'type_tontine'          => $user->tontineType?->nom,
                'montant_total_cotise'  => $this->calculerMontantTotalCotise($user),
                'ordre_passage'         => $user->ordre_passage,
            ];
        });

        return response()->json(array_merge(
            $membres->toArray(),
            ['data' => $data]
        ));
    }

    /**
     * Calcule le montant total cotisé : TontineType.montant × périodes écoulées.
     */
    private function calculerMontantTotalCotise(User $user): string
    {
        if (! $user->date_adhesion || ! $user->tontineType || ! $user->tontine) {
            return '0.00';
        }

        $periodes = $this->periodesEcoulees($user->date_adhesion, $user->tontine->frequence);
        $montant  = (float) $user->tontineType->montant * $periodes;

        return number_format($montant, 2, '.', '');
    }

    /**
     * Calcule le statut de paiement : 'payé' ou 'en retard'.
     */
    private function calculerStatutPaiement(User $user): string
    {
        if (! $user->date_adhesion || ! $user->tontine) {
            return 'en retard';
        }

        $prochaine = $this->prochaineEcheance($user->date_adhesion, $user->tontine->frequence);

        return Carbon::now()->greaterThan($prochaine) ? 'en retard' : 'payé';
    }

    /**
     * Nombre de périodes complètes écoulées depuis date_adhesion jusqu'à aujourd'hui.
     */
    private function periodesEcoulees(Carbon $dateAdhesion, string $frequence): int
    {
        $now = Carbon::now();

        return match ($frequence) {
            'hebdomadaire' => (int) $dateAdhesion->diffInWeeks($now),
            'mensuel'      => (int) $dateAdhesion->diffInMonths($now),
            'trimestriel'  => (int) floor($dateAdhesion->diffInMonths($now) / 3),
            default        => 0,
        };
    }

    /**
     * Date de la prochaine échéance attendue après la dernière période complète.
     */
    private function prochaineEcheance(Carbon $dateAdhesion, string $frequence): Carbon
    {
        $periodes = $this->periodesEcoulees($dateAdhesion, $frequence);

        return match ($frequence) {
            'hebdomadaire' => $dateAdhesion->copy()->addWeeks($periodes + 1),
            'mensuel'      => $dateAdhesion->copy()->addMonths($periodes + 1),
            'trimestriel'  => $dateAdhesion->copy()->addMonths(($periodes + 1) * 3),
            default        => $dateAdhesion->copy(),
        };
    }
}
