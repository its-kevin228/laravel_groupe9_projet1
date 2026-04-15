# Tâches d'Implémentation — Gestion des Tontines

## Tâches

- [ ] 1. Migrations base de données
  - [ ] 1.1 Créer la migration pour modifier l'enum `statut` de la table `tontines` (de `active/inactive/terminee` vers `en_attente/active/terminee/archivee`, défaut `en_attente`)
  - [ ] 1.2 Créer la migration pour la table pivot `tontine_user` (tontine_id FK cascade, user_id FK cascade, ordre_passage unsignedInteger not null, date_adhesion date not null, date_retrait date nullable, ajoute_par bigint FK users nullable, timestamps, unique composite (tontine_id, user_id), unique composite (tontine_id, ordre_passage))
  - [ ] 1.3 Créer la migration pour supprimer les colonnes `tontine_id`, `ordre_passage`, `date_adhesion` de la table `users`

- [ ] 2. Mise à jour des Models
  - [ ] 2.1 Mettre à jour `app/Models/Tontine.php` : remplacer `HasMany` par `BelongsToMany` vers `User` via `tontine_user` avec pivot (ordre_passage, date_adhesion, date_retrait, ajoute_par), ajouter les méthodes `peutEtreModifiee()`, `peutAjouterMembres()`, `peutEtreSupprimee()`
  - [ ] 2.2 Mettre à jour `app/Models/User.php` : remplacer `tontine(): BelongsTo` par `tontines(): BelongsToMany`, retirer `tontine_id`, `ordre_passage`, `date_adhesion` du `$fillable` et des `$casts`
  - [ ] 2.3 Créer `app/Models/TontineUser.php` : model pivot étendant `Illuminate\Database\Eloquent\Relations\Pivot` avec les champs de la table pivot et les casts de dates

- [ ] 3. FormRequests de validation
  - [ ] 3.1 Créer `app/Http/Requests/Admin/StoreTontineRequest.php` : nom required|string, montant_cotisation required|numeric|gt:0, frequence required|in:hebdomadaire,mensuel,trimestriel, date_debut required|date, description nullable|string
  - [ ] 3.2 Créer `app/Http/Requests/Admin/UpdateTontineRequest.php` : mêmes règles en `sometimes`, statut sometimes|in:en_attente,active,terminee,archivee
  - [ ] 3.3 Créer `app/Http/Requests/Admin/AjouterMembreRequest.php` : user_id required|exists:users,id, ordre_passage required|integer|min:1, date_adhesion required|date

- [ ] 4. Contrôleurs Admin
  - [ ] 4.1 Créer `app/Http/Controllers/Admin/TontineController.php` avec les méthodes :
    - `index` : retourner toutes les tontines avec `withCount('membres')` → 200
    - `store` : valider via StoreTontineRequest, créer la tontine → 201
    - `show` : retourner la tontine avec ses membres (pivot : ordre_passage, date_adhesion) → 200 ou 404
    - `update` : vérifier `peutEtreModifiee()` sinon 422, valider via UpdateTontineRequest, mettre à jour → 200
    - `destroy` : vérifier `peutEtreSupprimee()` sinon 422, supprimer → 200
  - [ ] 4.2 Créer `app/Http/Controllers/Admin/MembreTontineController.php` avec les méthodes :
    - `store` : vérifier `peutAjouterMembres()` sinon 422, vérifier unicité membre + ordre_passage, créer ligne pivot avec date_adhesion + ajoute_par → 200
    - `destroy` : vérifier que le membre appartient à la tontine sinon 422, supprimer la ligne pivot → 200

- [ ] 5. Contrôleur Membre
  - [ ] 5.1 Créer `app/Http/Controllers/Membre/MesTontinesController.php` avec les méthodes :
    - `index` : retourner `auth()->user()->tontines()->with('membres')` → 200
    - `show` : vérifier que le membre appartient à la tontine sinon 403, retourner la tontine avec ses membres → 200

- [ ] 6. Enregistrement des routes
  - [ ] 6.1 Ajouter dans `routes/api.php` les routes admin sous `middleware('role:admin')->prefix('admin')` : GET/POST tontines, GET/PUT/DELETE tontines/{tontine}, POST tontines/{tontine}/membres, DELETE tontines/{tontine}/membres/{user}
  - [ ] 6.2 Ajouter dans `routes/api.php` les routes membre sous `middleware('auth:sanctum')` : GET mes-tontines, GET mes-tontines/{tontine}

- [ ] 7. Tests unitaires
  - [ ] 7.1 Créer `tests/Feature/Admin/TontineControllerTest.php` : tester création (201), validation champs invalides (422), modification (200/422 selon statut), suppression (200/422 selon statut), liste avec membres_count, détail avec membres, 401 non authentifié, 403 rôle membre
  - [ ] 7.2 Créer `tests/Feature/Admin/MembreTontineControllerTest.php` : tester ajout membre valide (200), doublon (422), ordre_passage doublon (422), tontine terminee/archivee (422), retrait membre (200), retrait membre absent (422), isolation des autres tontines du membre
  - [ ] 7.3 Créer `tests/Feature/Membre/MesTontinesControllerTest.php` : tester liste tontines du membre (200), détail tontine membre (200), accès tontine non-membre (403), liste vide (200 tableau vide), 401 non authentifié

- [ ] 8. Tests de propriétés (PBT)
  - [ ] 8.1 Créer `tests/Feature/Properties/TontineStatutPropertyTest.php` :
    - Property 3 : Pour toute tontine avec statut terminee/archivee → PUT retourne 422
    - Property 4 : Pour toute tontine avec statut en_attente/active/archivee → DELETE retourne 422
  - [ ] 8.2 Créer `tests/Feature/Properties/MembreTontinePropertyTest.php` :
    - Property 7 : Pour tout membre déjà inscrit → second ajout retourne 422
    - Property 8 : Pour tout ordre_passage déjà utilisé → nouvel ajout avec même ordre retourne 422
    - Property 9 : Pour toute tontine terminee/archivee → ajout membre retourne 422
    - Property 10 : Retrait d'une tontine préserve les autres inscriptions du membre
  - [ ] 8.3 Créer `tests/Feature/Properties/MesTontinesPropertyTest.php` :
    - Property 11 : Pour tout membre, GET mes-tontines retourne exactement ses tontines
    - Property 12 : Pour toute tontine non-membre → GET mes-tontines/{id} retourne 403
