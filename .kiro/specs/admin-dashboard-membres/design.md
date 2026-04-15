# Admin Dashboard Membres — Bugfix Design

## Overview

L'admin ne peut pas consulter la liste des membres car aucune route ni contrôleur n'existe pour cela.
La correction consiste à créer `AdminMembreController` avec un endpoint `GET /api/admin/membres`,
protégé par `auth:sanctum` + `role:admin`, qui retourne les données membres enrichies
(statut paiement calculé, montant cotisé estimé) en attendant une future table `cotisations`.

---

## Glossary

- **Bug_Condition (C)** : L'admin tente d'accéder à `GET /api/admin/membres` — route inexistante
- **Property (P)** : La réponse doit contenir la liste paginée des membres avec tous les champs requis
- **Preservation** : Les routes d'auth et de gestion des types de tontine ne doivent pas être affectées
- **AdminMembreController** : Nouveau contrôleur dans `app/Http/Controllers/Admin/`
- **statut_paiement** : Champ calculé — `payé` si le membre est à jour, `en retard` sinon
- **montant_total_cotise** : `TontineType.montant × nombre_de_périodes_écoulées` depuis `date_adhesion`
- **ordre_passage** : Position du membre dans la file de bénéficiaires (colonne `ordre_passage` sur `users`)

---

## Bug Details

### Bug Condition

Le bug se manifeste dès qu'un admin authentifié appelle `GET /api/admin/membres`.
La route n'est pas déclarée dans `routes/api.php`, donc Laravel retourne 404.
Aucun contrôleur, aucune logique de calcul des champs dérivés n'existe.

**Formal Specification:**
```
FUNCTION isBugCondition(request)
  INPUT: request de type HttpRequest
  OUTPUT: boolean

  RETURN request.method = 'GET'
         AND request.path = '/api/admin/membres'
         AND request.user.role = 'admin'
         AND route('/api/admin/membres') NOT EXISTS
END FUNCTION
```

### Examples

- `GET /api/admin/membres` avec token admin → 404 (attendu : 200 + liste membres)
- `GET /api/admin/membres` avec token membre → 404 (attendu : 403)
- `GET /api/admin/membres` sans token → 404 (attendu : 401)

---

## Expected Behavior

### Preservation Requirements

**Unchanged Behaviors:**
- `POST /api/auth/register` crée un compte et retourne un token Sanctum
- `POST /api/auth/login` authentifie et retourne le profil avec `tontine` et `tontineType`
- `GET /api/auth/me` retourne le profil de l'utilisateur connecté
- CRUD `GET|POST|PUT|DELETE /api/admin/tontine-types` fonctionne comme avant

**Scope:**
Tout ce qui ne touche pas à la nouvelle route `/api/admin/membres` doit rester strictement identique.
Aucune modification des modèles existants, des middlewares, ni des contrôleurs existants.

---

## Hypothesized Root Cause

1. **Route manquante** : `routes/api.php` ne déclare pas `GET /api/admin/membres`
   - C'est la cause directe du 404

2. **Contrôleur absent** : Aucun `AdminMembreController` n'existe pour traiter la requête

3. **Logique métier manquante** : Le calcul de `statut_paiement` et `montant_total_cotise`
   n'est implémenté nulle part (pas de table `cotisations`)

4. **Absence de table cotisations** : Le statut paiement doit être estimé à partir de
   `date_adhesion` + `Tontine.frequence` + `TontineType.montant` en attendant une vraie table

---

## Correctness Properties

Property 1: Bug Condition - Endpoint Admin Membres Accessible

_For any_ requête `GET /api/admin/membres` émise par un admin authentifié (isBugCondition returns true),
le système fixé SHALL retourner HTTP 200 avec un objet JSON paginé contenant pour chaque membre :
`nom_complet`, `phone`, `email`, `statut_paiement` (`payé`|`en retard`), `type_tontine`,
`montant_total_cotise`, `ordre_passage`.

**Validates: Requirements 2.1, 2.2, 2.3**

Property 2: Preservation - Routes Existantes Non Affectées

_For any_ requête vers les routes existantes (`/api/auth/*`, `/api/admin/tontine-types`, `/api/tontine-types`),
le système fixé SHALL produire exactement le même résultat qu'avant la correction,
préservant l'authentification, la gestion des types de tontine et les profils membres.

**Validates: Requirements 3.1, 3.2, 3.3, 3.4**

---

## Fix Implementation

### Changes Required

**Fichier 1** : `app/Http/Controllers/Admin/AdminMembreController.php` *(à créer)*

**Méthode** : `index(Request $request): JsonResponse`

**Logique** :
1. Récupérer tous les `User` où `role = 'membre'` avec eager loading `tontine`, `tontineType`
2. Pour chaque membre, calculer `montant_total_cotise` :
   - Récupérer `TontineType.montant` et `Tontine.frequence`
   - Calculer le nombre de périodes écoulées depuis `date_adhesion` jusqu'à aujourd'hui
   - `montant_total_cotise = montant × periodes`
3. Pour chaque membre, calculer `statut_paiement` :
   - Déterminer la date de la prochaine cotisation attendue selon `frequence`
   - Si la date courante dépasse cette échéance → `en retard`, sinon → `payé`
4. Retourner une réponse paginée (15 par page)

**Fichier 2** : `routes/api.php` *(à modifier)*

Ajouter dans le groupe `middleware('role:admin')->prefix('admin')` :
```php
Route::get('membres', [AdminMembreController::class, 'index']);
```

---

## Testing Strategy

### Validation Approach

Approche en deux phases : d'abord confirmer le bug (404 sur unfixed code), puis vérifier
que le fix retourne les bonnes données sans casser les routes existantes.

### Exploratory Bug Condition Checking

**Goal** : Confirmer que `GET /api/admin/membres` retourne 404 sur le code non corrigé.

**Test Plan** : Créer un test Feature qui s'authentifie en tant qu'admin et appelle l'endpoint.
Exécuter sur le code UNFIXED pour observer l'échec.

**Test Cases** :
1. **Admin authentifié → 404** : Appel avec token admin valide (échouera sur unfixed code)
2. **Champs manquants** : Vérifier que `statut_paiement` et `montant_total_cotise` sont absents (échouera)
3. **Non-admin → 403** : Appel avec token membre (échouera car route inexistante → 404 au lieu de 403)

**Expected Counterexamples** :
- La réponse est 404 au lieu de 200 pour un admin
- Les champs calculés sont absents de la réponse

### Fix Checking

**Goal** : Vérifier que pour tout admin authentifié, l'endpoint retourne les données correctes.

**Pseudocode:**
```
FOR ALL request WHERE isBugCondition(request) DO
  response := GET /api/admin/membres (fixed)
  ASSERT response.status = 200
  ASSERT response.data[*] contains {nom_complet, phone, email, statut_paiement, type_tontine, montant_total_cotise, ordre_passage}
  ASSERT response.data[*].statut_paiement IN ['payé', 'en retard']
END FOR
```

### Preservation Checking

**Goal** : Vérifier que les routes existantes fonctionnent identiquement après le fix.

**Pseudocode:**
```
FOR ALL request WHERE NOT isBugCondition(request) DO
  ASSERT original_response(request) = fixed_response(request)
END FOR
```

**Testing Approach** : Tests property-based sur les routes d'auth avec des données générées aléatoirement
(emails, noms, mots de passe valides) pour garantir qu'aucune régression n'est introduite.

**Test Cases** :
1. **Register Preservation** : `POST /api/auth/register` retourne toujours 201 + token
2. **Login Preservation** : `POST /api/auth/login` retourne toujours 200 + profil + token
3. **Me Preservation** : `GET /api/auth/me` retourne toujours le profil complet
4. **TontineType CRUD Preservation** : Les opérations admin sur tontine-types fonctionnent

### Unit Tests

- Calcul de `montant_total_cotise` pour différentes fréquences (mensuel, hebdomadaire, annuel)
- Calcul de `statut_paiement` pour un membre à jour vs en retard
- Accès refusé (403) pour un utilisateur avec `role = 'membre'`

### Property-Based Tests

- Pour tout membre avec `date_adhesion` valide, `montant_total_cotise >= 0`
- Pour tout membre, `statut_paiement` est toujours `payé` ou `en retard` (jamais null)
- Pour toute combinaison email/password valide, le login retourne un token (préservation)

### Integration Tests

- Flux complet : inscription → connexion admin → consultation liste membres
- Vérification que la pagination fonctionne (page 1, page 2, per_page)
- Vérification que les relations `tontine` et `tontineType` sont bien chargées
