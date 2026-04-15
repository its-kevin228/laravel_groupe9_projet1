<?php

namespace Tests\Feature\Admin;

use App\Models\TontineType;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Preservation Property Tests — Property 2
 *
 * Validates: Requirements 3.1, 3.2, 3.3, 3.4
 *
 * Ces tests vérifient que les routes existantes continuent de fonctionner
 * correctement AVANT et APRÈS l'implémentation du fix.
 * EXPECTED OUTCOME: Tous les tests PASSENT sur le code non corrigé.
 */
class PreservationTest extends TestCase
{
    use RefreshDatabase;

    // -------------------------------------------------------------------------
    // Property 3.1 — POST /api/auth/register retourne 201 + token
    // -------------------------------------------------------------------------

    /**
     * Property 3.1: Pour tout ensemble valide (first_name, last_name, email,
     * phone, password, tontine_type_id), register retourne 201 + token.
     *
     * Validates: Requirements 3.1
     */
    public function test_register_retourne_201_et_token_avec_donnees_valides(): void
    {
        $tontineType = TontineType::create([
            'nom'         => 'Bronze',
            'montant'     => 5000,
            'devise'      => 'FCFA',
            'description' => 'Formule de base',
            'actif'       => true,
        ]);

        $response = $this->postJson('/api/auth/register', [
            'first_name'            => 'Alice',
            'last_name'             => 'Dupont',
            'email'                 => 'alice@example.com',
            'phone'                 => '+22890000001',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
            'tontine_type_id'       => $tontineType->id,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'user'  => ['id', 'first_name', 'last_name', 'email', 'phone'],
            'token',
        ]);
        $this->assertNotEmpty($response->json('token'));
    }

    /**
     * Property 3.1 (variante): Un second utilisateur avec des données différentes
     * peut aussi s'inscrire et obtenir un token.
     *
     * Validates: Requirements 3.1
     */
    public function test_register_retourne_201_et_token_pour_differents_utilisateurs(): void
    {
        $tontineType = TontineType::create([
            'nom'         => 'Silver',
            'montant'     => 10000,
            'devise'      => 'FCFA',
            'description' => 'Formule intermédiaire',
            'actif'       => true,
        ]);

        $payloads = [
            [
                'first_name'            => 'Bob',
                'last_name'             => 'Martin',
                'email'                 => 'bob@example.com',
                'phone'                 => '+22890000002',
                'password'              => 'securepass1',
                'password_confirmation' => 'securepass1',
                'tontine_type_id'       => $tontineType->id,
            ],
            [
                'first_name'            => 'Claire',
                'last_name'             => 'Leblanc',
                'email'                 => 'claire@example.com',
                'phone'                 => '+22890000003',
                'password'              => 'securepass2',
                'password_confirmation' => 'securepass2',
                'tontine_type_id'       => $tontineType->id,
            ],
        ];

        foreach ($payloads as $payload) {
            $response = $this->postJson('/api/auth/register', $payload);
            $response->assertStatus(201);
            $this->assertNotEmpty($response->json('token'));
        }
    }

    // -------------------------------------------------------------------------
    // Property 3.2 — POST /api/auth/login retourne 200 + profil + token
    // -------------------------------------------------------------------------

    /**
     * Property 3.2: Pour tout utilisateur existant, login retourne 200 + profil + token.
     *
     * Validates: Requirements 3.2
     */
    public function test_login_retourne_200_profil_et_token(): void
    {
        $user = User::factory()->create([
            'email'    => 'membre@example.com',
            'password' => bcrypt('password123'),
            'role'     => 'membre',
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email'    => 'membre@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'user'  => ['id', 'first_name', 'last_name', 'email'],
            'token',
        ]);
        $this->assertNotEmpty($response->json('token'));
        $this->assertEquals($user->id, $response->json('user.id'));
    }

    /**
     * Property 3.2 (admin): Un admin peut aussi se connecter et obtenir un token.
     *
     * Validates: Requirements 3.2
     */
    public function test_login_fonctionne_pour_un_admin(): void
    {
        User::factory()->create([
            'email'    => 'admin@example.com',
            'password' => bcrypt('adminpass1'),
            'role'     => 'admin',
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email'    => 'admin@example.com',
            'password' => 'adminpass1',
        ]);

        $response->assertStatus(200);
        $this->assertNotEmpty($response->json('token'));
        $this->assertEquals('admin', $response->json('user.role'));
    }

    // -------------------------------------------------------------------------
    // Property 3.4 — GET /api/auth/me retourne le profil complet
    // -------------------------------------------------------------------------

    /**
     * Property 3.4: Pour tout utilisateur authentifié, GET /api/auth/me
     * retourne son profil complet.
     *
     * Validates: Requirements 3.4
     */
    public function test_me_retourne_le_profil_complet_quand_authentifie(): void
    {
        $user = User::factory()->create([
            'first_name' => 'Jean',
            'last_name'  => 'Dupuis',
            'email'      => 'jean@example.com',
            'role'       => 'membre',
        ]);

        $response = $this->actingAs($user, 'sanctum')
                         ->getJson('/api/auth/me');

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'id'         => $user->id,
            'first_name' => 'Jean',
            'last_name'  => 'Dupuis',
            'email'      => 'jean@example.com',
        ]);
    }

    /**
     * Property 3.4 (non authentifié): GET /api/auth/me sans token retourne 401.
     *
     * Validates: Requirements 3.4
     */
    public function test_me_retourne_401_sans_authentification(): void
    {
        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(401);
    }

    // -------------------------------------------------------------------------
    // Property 3.3 — GET /api/admin/tontine-types retourne 200 pour un admin
    // -------------------------------------------------------------------------

    /**
     * Property 3.3: Pour tout admin authentifié, GET /api/admin/tontine-types
     * (via la route publique) retourne 200.
     *
     * Validates: Requirements 3.3
     */
    public function test_tontine_types_index_retourne_200_pour_un_admin(): void
    {
        TontineType::create([
            'nom'         => 'Gold',
            'montant'     => 25000,
            'devise'      => 'FCFA',
            'description' => 'Formule premium',
            'actif'       => true,
        ]);

        $admin = User::factory()->create(['role' => 'admin']);

        // La route GET /api/tontine-types est publique mais on la teste en tant qu'admin
        $response = $this->actingAs($admin, 'sanctum')
                         ->getJson('/api/tontine-types');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'nom', 'montant', 'devise'],
        ]);
    }

    /**
     * Property 3.3 (CRUD admin): Un admin peut créer un type de tontine (POST).
     *
     * Validates: Requirements 3.3
     */
    public function test_admin_peut_creer_un_type_de_tontine(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin, 'sanctum')
                         ->postJson('/api/admin/tontine-types', [
                             'nom'         => 'Platinum',
                             'montant'     => 50000,
                             'devise'      => 'FCFA',
                             'description' => 'Formule exclusive',
                             'actif'       => true,
                         ]);

        $response->assertStatus(201);
        $response->assertJsonFragment(['nom' => 'Platinum']);
    }

    /**
     * Property 3.3 (accès refusé): Un membre ne peut pas créer un type de tontine.
     *
     * Validates: Requirements 3.3
     */
    public function test_membre_ne_peut_pas_creer_un_type_de_tontine(): void
    {
        $membre = User::factory()->create(['role' => 'membre']);

        $response = $this->actingAs($membre, 'sanctum')
                         ->postJson('/api/admin/tontine-types', [
                             'nom'     => 'Unauthorized',
                             'montant' => 1000,
                         ]);

        $response->assertStatus(403);
    }
}
