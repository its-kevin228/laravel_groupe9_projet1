# Implementation Plan

- [x] 1. Write bug condition exploration test
  - **Property 1: Bug Condition** - Endpoint Admin Membres Accessible
  - **CRITICAL**: Ce test DOIT ÉCHOUER sur le code non corrigé — l'échec confirme que le bug existe
  - **DO NOT attempt to fix the test or the code when it fails**
  - **NOTE**: Ce test encode le comportement attendu — il validera le fix quand il passera après implémentation
  - **GOAL**: Confirmer que `GET /api/admin/membres` retourne 404 sur le code actuel
  - **Scoped PBT Approach**: Scoper la propriété au cas concret : admin authentifié + appel GET /api/admin/membres
  - Créer `tests/Feature/Admin/AdminMembreIndexTest.php`
  - Créer un User avec `role = 'admin'` via factory, générer un token Sanctum
  - Appeler `GET /api/admin/membres` avec le header `Authorization: Bearer {token}`
  - Asserter HTTP 200 et la présence des champs : `nom_complet`, `phone`, `email`, `statut_paiement`, `type_tontine`, `montant_total_cotise`, `ordre_passage`
  - Asserter que `statut_paiement` vaut `payé` ou `en retard`
  - Exécuter sur le code UNFIXED : `php artisan test --filter AdminMembreIndexTest`
  - **EXPECTED OUTCOME**: Test ÉCHOUE avec 404 (confirme que le bug existe)
  - Documenter le counterexample trouvé (ex: "réponse 404 au lieu de 200")
  - Marquer la tâche complète quand le test est écrit, exécuté, et l'échec documenté
  - _Requirements: 1.1, 1.2, 2.1, 2.2, 2.3_

- [x] 2. Write preservation property tests (BEFORE implementing fix)
  - **Property 2: Preservation** - Routes Existantes Non Affectées
  - **IMPORTANT**: Suivre la méthodologie observation-first
  - Créer `tests/Feature/Admin/PreservationTest.php`
  - Observer sur le code UNFIXED : `POST /api/auth/register` retourne 201 + token
  - Observer sur le code UNFIXED : `POST /api/auth/login` retourne 200 + profil + token
  - Observer sur le code UNFIXED : `GET /api/auth/me` retourne le profil complet
  - Observer sur le code UNFIXED : `GET /api/admin/tontine-types` retourne 200 pour un admin
  - Écrire des tests property-based : pour tout ensemble valide (email, password, first_name, last_name, tontine_type_id), register retourne 201
  - Écrire des tests property-based : pour tout admin, les routes tontine-types CRUD retournent les bons codes HTTP
  - Exécuter sur le code UNFIXED : `php artisan test --filter PreservationTest`
  - **EXPECTED OUTCOME**: Tests PASSENT (confirme le comportement de base à préserver)
  - Marquer la tâche complète quand les tests sont écrits, exécutés, et passants sur le code non corrigé
  - _Requirements: 3.1, 3.2, 3.3, 3.4_

- [x] 3. Fix — Endpoint dashboard membres admin

  - [x] 3.1 Créer AdminMembreController
    - Créer `app/Http/Controllers/Admin/AdminMembreController.php`
    - Méthode `index()` : récupérer les Users avec `role = 'membre'`, eager load `tontine` et `tontineType`
    - Calculer `montant_total_cotise` : `TontineType.montant × periodes_ecoulees(date_adhesion, tontine.frequence)`
    - Calculer `statut_paiement` : comparer la date de la prochaine échéance avec `now()` → `payé` ou `en retard`
    - Retourner une réponse paginée (15 par page) avec les champs : `nom_complet`, `phone`, `email`, `statut_paiement`, `type_tontine`, `montant_total_cotise`, `ordre_passage`
    - _Bug_Condition: isBugCondition(request) — GET /api/admin/membres par un admin authentifié_
    - _Expected_Behavior: HTTP 200 + liste paginée avec tous les champs requis_
    - _Preservation: Ne pas modifier les contrôleurs existants (AuthController, TontineTypeController)_
    - _Requirements: 2.1, 2.2, 2.3, 2.4_

  - [x] 3.2 Enregistrer la route dans api.php
    - Ajouter dans le groupe `middleware('role:admin')->prefix('admin')` de `routes/api.php` :
      `Route::get('membres', [AdminMembreController::class, 'index']);`
    - Vérifier que le middleware `auth:sanctum` + `role:admin` s'applique bien
    - _Requirements: 2.1, 2.4_

  - [x] 3.3 Verify bug condition exploration test now passes
    - **Property 1: Expected Behavior** - Endpoint Admin Membres Accessible
    - **IMPORTANT**: Re-exécuter le MÊME test de la tâche 1 — ne PAS écrire un nouveau test
    - Le test de la tâche 1 encode le comportement attendu
    - Quand ce test passe, cela confirme que le comportement attendu est satisfait
    - Exécuter : `php artisan test --filter AdminMembreIndexTest`
    - **EXPECTED OUTCOME**: Test PASSE (confirme que le bug est corrigé)
    - _Requirements: 2.1, 2.2, 2.3_

  - [x] 3.4 Verify preservation tests still pass
    - **Property 2: Preservation** - Routes Existantes Non Affectées
    - **IMPORTANT**: Re-exécuter les MÊMES tests de la tâche 2 — ne PAS écrire de nouveaux tests
    - Exécuter : `php artisan test --filter PreservationTest`
    - **EXPECTED OUTCOME**: Tests PASSENT (confirme l'absence de régression)
    - Confirmer que register, login, me et tontine-types fonctionnent toujours

- [x] 4. Checkpoint — Ensure all tests pass
  - Exécuter la suite complète : `php artisan test`
  - Tous les tests doivent passer, demander à l'utilisateur si des questions se posent
