<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Bug Condition Exploration Test — Property 1
 *
 * Validates: Requirements 1.1, 1.2, 2.1, 2.2, 2.3
 *
 * CRITICAL: Ce test DOIT ÉCHOUER sur le code non corrigé.
 * L'échec confirme que le bug existe (route GET /api/admin/membres absente → 404).
 * Il passera après implémentation du fix (tâche 3).
 */
class AdminMembreIndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Property 1: Bug Condition — Endpoint Admin Membres Accessible
     *
     * Un admin authentifié appelle GET /api/admin/membres.
     * Comportement attendu (post-fix) : HTTP 200 + champs requis présents.
     * Comportement actuel (pre-fix)   : HTTP 404 → confirme le bug.
     *
     * Validates: Requirements 1.1, 2.1, 2.2, 2.3
     */
    public function test_admin_peut_acceder_a_la_liste_des_membres(): void
    {
        // Arrange — créer un admin et s'authentifier via Sanctum
        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name'  => 'Test',
            'email'      => 'admin@test.com',
            'phone'      => '0600000000',
            'role'       => 'admin',
        ]);

        // Act — appeler l'endpoint en tant qu'admin authentifié
        $response = $this->actingAs($admin, 'sanctum')
                         ->getJson('/api/admin/membres');

        // Assert — HTTP 200 et présence des champs requis
        $response->assertStatus(200);

        // La réponse doit contenir une liste paginée avec les champs attendus
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'nom_complet',
                    'phone',
                    'email',
                    'statut_paiement',
                    'type_tontine',
                    'montant_total_cotise',
                    'ordre_passage',
                ],
            ],
        ]);
    }

    /**
     * Property 1 (complément) — statut_paiement doit valoir "payé" ou "en retard"
     *
     * Validates: Requirements 2.2
     */
    public function test_statut_paiement_est_paye_ou_en_retard(): void
    {
        // Arrange — admin + au moins un membre
        $admin = User::factory()->create([
            'first_name' => 'Admin',
            'last_name'  => 'Test',
            'email'      => 'admin2@test.com',
            'phone'      => '0600000001',
            'role'       => 'admin',
        ]);

        User::factory()->create([
            'first_name'    => 'Membre',
            'last_name'     => 'Un',
            'email'         => 'membre1@test.com',
            'phone'         => '0600000002',
            'role'          => 'membre',
            'date_adhesion' => now()->subMonths(3)->toDateString(),
        ]);

        // Act
        $response = $this->actingAs($admin, 'sanctum')
                         ->getJson('/api/admin/membres');

        $response->assertStatus(200);

        // Assert — chaque membre a un statut_paiement valide
        $membres = $response->json('data');
        foreach ($membres as $membre) {
            $this->assertContains(
                $membre['statut_paiement'],
                ['payé', 'en retard'],
                "statut_paiement doit être 'payé' ou 'en retard', reçu : {$membre['statut_paiement']}"
            );
        }
    }
}
