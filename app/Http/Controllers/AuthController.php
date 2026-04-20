<?php

namespace App\Http\Controllers;

use App\Models\TontineType;
use App\Models\Tontine;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

/**
 * @group Authentification
 *
 * Inscription, connexion et gestion de session.
 */
class AuthController extends Controller
{
    /**
     * Données du formulaire d'inscription
     *
     * Retourne les types de tontine et les tontines disponibles
     * pour alimenter les selects du formulaire d'inscription.
     *
     * @unauthenticated
     *
     * @response {
     *   "tontine_types": [
     *     { "id": 1, "nom": "Bronze", "montant": "5000.00", "devise": "FCFA", "description": "Formule de base" },
     *     { "id": 2, "nom": "Silver", "montant": "10000.00", "devise": "FCFA", "description": "Formule intermédiaire" },
     *     { "id": 3, "nom": "Gold",   "montant": "25000.00", "devise": "FCFA", "description": "Formule premium" }
     *   ],
     *   "tontines": [
     *     { "id": 1, "nom": "Tontine Solidarité", "frequence": "mensuel" }
     *   ]
     * }
     */
    public function registerForm(): JsonResponse
    {
        return response()->json([
            'tontine_types' => TontineType::where('actif', true)
                                ->select('id', 'nom', 'montant', 'devise', 'description')
                                ->orderBy('montant')
                                ->get(),
            'tontines'      => Tontine::where('statut', 'active')
                                ->select('id', 'nom', 'frequence')
                                ->get(),
        ]);
    }

    /**
     * Inscription
     *
     * Crée un nouveau compte membre et retourne un token Sanctum.
     *
     * @unauthenticated
     *
     * @bodyParam first_name string required Prénom. Example: Alice
     * @bodyParam last_name string required Nom de famille. Example: Dupont
     * @bodyParam email string required Adresse email unique. Example: alice@example.com
     * @bodyParam phone string required Numéro de téléphone unique. Example: +22890000000
     * @bodyParam password string required Mot de passe (min 8 caractères). Example: password123
     * @bodyParam password_confirmation string required Confirmation du mot de passe. Example: password123
     * @bodyParam role string Rôle : admin ou membre (défaut: membre). Example: membre
     * @bodyParam tontine_id integer ID de la tontine concernée. Example: 1
     * @bodyParam tontine_type_id integer required ID du type de tontine choisi (Bronze, Silver, Gold…). Example: 2
     * @bodyParam date_adhesion string Date d'adhésion (YYYY-MM-DD). Example: 2026-01-15
     * @bodyParam ordre_passage integer Position dans la file de bénéficiaires. Example: 3
     * @bodyParam adresse string Adresse complète. Example: 12 Rue des Fleurs
     * @bodyParam quartier string Quartier de résidence. Example: Bè Kpota
     * @bodyParam profession string Profession. Example: Commerçante
     * @bodyParam piece_identite_type string Type de pièce d'identité (CNI, Passeport, etc.). Example: CNI
     * @bodyParam piece_identite_numero string Numéro de la pièce d'identité. Example: TG-123456
     *
     * @response 201 scenario="Succès" {
     *   "user": {
     *     "id": 1,
     *     "first_name": "Alice",
     *     "last_name": "Dupont",
     *     "email": "alice@example.com",
     *     "phone": "+22890000000",
     *     "role": "membre",
     *     "tontine_id": 1,
     *     "tontine_type_id": 2,
     *     "date_adhesion": "2026-01-15",
     *     "ordre_passage": 3,
     *     "tontine_type": { "id": 2, "nom": "Silver", "montant": "10000.00", "devise": "FCFA" }
     *   },
     *   "token": "1|xxxxxxxxxxxxxxxxxxxxxxxx"
     * }
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->validate([
            'first_name'            => 'required|string|max:100',
            'last_name'             => 'required|string|max:100',
            'email'                 => 'required|email|unique:users,email',
            'phone'                 => 'required|string|max:20|unique:users,phone',
            'password'              => 'required|string|min:8|confirmed',
            'role'                  => 'sometimes|in:admin,membre',
            'tontine_id'            => 'nullable|exists:tontines,id',
            'date_adhesion'         => 'nullable|date',
            'ordre_passage'         => 'nullable|integer|min:1',
            'adresse'               => 'nullable|string|max:255',
            'quartier'              => 'nullable|string|max:100',
            'profession'            => 'nullable|string|max:100',
            'piece_identite_type'   => 'nullable|string|max:50',
            'piece_identite_numero' => 'nullable|string|max:100',
        ]);

        $user  = User::create($data);
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'  => $user->load('tontine', 'tontineTypes'),
            'token' => $token,
        ], 201);
    }

    /**
     * Connexion
     *
     * Authentifie l'utilisateur via email/mot de passe et retourne un token Sanctum.
     *
     * @unauthenticated
     *
     * @bodyParam email string required Adresse email. Example: alice@example.com
     * @bodyParam password string required Mot de passe. Example: password123
     *
     * @response scenario="Succès" {
     *   "user": { "id": 1, "first_name": "Alice", "last_name": "Dupont", "role": "membre" },
     *   "token": "1|xxxxxxxxxxxxxxxxxxxxxxxx"
     * }
     * @response 422 scenario="Identifiants incorrects" {
     *   "message": "Les identifiants sont incorrects.",
     *   "errors": { "email": ["Les identifiants sont incorrects."] }
     * }
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (! Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants sont incorrects.'],
            ]);
        }

        $user  = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user'  => $user->load('tontine', 'tontineTypes'),
            'token' => $token,
        ]);
    }

    /**
     * Profil connecté
     *
     * Retourne le profil complet de l'utilisateur authentifié.
     *
     * @authenticated
     *
     * @response {
     *   "id": 1,
     *   "first_name": "Alice",
     *   "last_name": "Dupont",
     *   "email": "alice@example.com",
     *   "phone": "+22890000000",
     *   "role": "membre",
     *   "tontine": { "id": 1, "nom": "Tontine Solidarité" }
     * }
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user()->load('tontine', 'tontineTypes'));
    }

    /**
     * Déconnexion
     *
     * Révoque le token actuel.
     *
     * @authenticated
     *
     * @response { "message": "Déconnecté avec succès." }
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Déconnecté avec succès.']);
    }
}
