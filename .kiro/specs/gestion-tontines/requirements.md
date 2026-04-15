# Document des Exigences — Gestion des Tontines

## Introduction

Cette fonctionnalité couvre la gestion complète des tontines dans l'application Laravel 12 + Sanctum + PostgreSQL. Elle inclut les opérations CRUD sur les tontines (réservées aux admins), la gestion de la relation tontine ↔ membres via une table pivot `tontine_user` (many-to-many), et la consultation par les membres de leurs propres tontines. Un membre peut appartenir à plusieurs tontines simultanément, mais ne peut pas être inscrit deux fois dans la même tontine. La suppression d'une tontine est conditionnée au statut `terminee`.

---

## Glossaire

- **TontineController** : Contrôleur Laravel gérant les opérations CRUD sur les tontines (accès admin).
- **MembreTontineController** : Contrôleur Laravel gérant l'assignation et le retrait de membres dans une tontine.
- **MembreTontineViewController** : Contrôleur Laravel gérant la consultation des tontines par les membres.
- **Tontine** : Entité représentant un groupe d'épargne rotatif, avec les champs `nom`, `description`, `montant_cotisation`, `frequence`, `date_debut`, `statut`.
- **Membre** : Utilisateur avec le rôle `membre`, lié à une ou plusieurs tontines via la table pivot `tontine_user`.
- **Admin** : Utilisateur avec le rôle `admin`, autorisé à effectuer toutes les opérations de gestion.
- **Statut** : Valeur enum de la tontine parmi `en_attente`, `active`, `terminee`, `archivee`.
- **tontine_user** : Table pivot many-to-many reliant les tontines aux membres, contenant `ordre_passage`, `date_adhesion`, `date_retrait` (nullable), `ajoute_par` (user_id de l'admin).
- **ordre_passage** : Entier non signé définissant la position d'un membre dans le cycle de rotation d'une tontine. Doit être unique au sein d'une même tontine. Les valeurs non consécutives sont autorisées (ex : 1, 5, 10).
- **date_adhesion** : Date à laquelle un membre a rejoint une tontine, stockée dans la table pivot `tontine_user`.
- **date_retrait** : Date à laquelle un membre a quitté une tontine, nullable, stockée dans la table pivot `tontine_user`.
- **ajoute_par** : Identifiant de l'admin ayant effectué l'assignation, stocké dans la table pivot `tontine_user`.
- **API** : Interface REST JSON exposée par l'application Laravel.

---

## Exigences

### Exigence 1 : Création d'une tontine

**User Story :** En tant qu'admin, je veux créer une nouvelle tontine, afin de démarrer un nouveau groupe d'épargne rotatif.

#### Critères d'acceptation

1. WHEN l'admin soumet une requête POST avec `nom`, `montant_cotisation`, `frequence` et `date_debut` valides, THE TontineController SHALL créer la tontine et retourner une réponse 201 avec les données de la tontine créée.
2. IF le champ `nom` est absent ou vide, THEN THE TontineController SHALL retourner une réponse 422 avec un message d'erreur de validation.
3. IF le champ `frequence` ne fait pas partie des valeurs `hebdomadaire`, `mensuel`, `trimestriel`, THEN THE TontineController SHALL retourner une réponse 422 avec un message d'erreur de validation.
4. IF le champ `montant_cotisation` est inférieur ou égal à zéro, THEN THE TontineController SHALL retourner une réponse 422 avec un message d'erreur de validation.
5. WHEN une tontine est créée sans `statut` explicite, THE TontineController SHALL assigner le statut `en_attente` par défaut.
6. IF un utilisateur non authentifié tente de créer une tontine, THEN THE API SHALL retourner une réponse 401.
7. IF un utilisateur avec le rôle `membre` tente de créer une tontine, THEN THE API SHALL retourner une réponse 403.

---

### Exigence 2 : Listage des tontines (admin)

**User Story :** En tant qu'admin, je veux lister toutes les tontines avec leur nombre de membres, afin d'avoir une vue d'ensemble des groupes.

#### Critères d'acceptation

1. WHEN l'admin envoie une requête GET sur la liste des tontines, THE TontineController SHALL retourner une réponse 200 avec la liste de toutes les tontines incluant le champ `membres_count` pour chaque tontine.
2. THE TontineController SHALL calculer `membres_count` comme le nombre de lignes actives dans la table pivot `tontine_user` pour chaque tontine.
3. WHEN aucune tontine n'existe, THE TontineController SHALL retourner une réponse 200 avec un tableau vide.
4. IF un utilisateur avec le rôle `membre` tente d'accéder à la liste admin des tontines, THEN THE API SHALL retourner une réponse 403.

---

### Exigence 3 : Détail d'une tontine (admin)

**User Story :** En tant qu'admin, je veux voir le détail d'une tontine avec la liste de ses membres, afin de gérer les participants.

#### Critères d'acceptation

1. WHEN l'admin envoie une requête GET sur une tontine existante, THE TontineController SHALL retourner une réponse 200 avec les données de la tontine et la liste de ses membres (id, first_name, last_name, email, phone, ordre_passage, date_adhesion).
2. IF la tontine demandée n'existe pas, THEN THE TontineController SHALL retourner une réponse 404.
3. IF un utilisateur avec le rôle `membre` tente d'accéder au détail admin d'une tontine, THEN THE API SHALL retourner une réponse 403.

---

### Exigence 4 : Modification d'une tontine

**User Story :** En tant qu'admin, je veux modifier les informations d'une tontine, afin de corriger ou mettre à jour ses paramètres.

#### Critères d'acceptation

1. WHEN l'admin soumet une requête PUT/PATCH avec des données valides sur une tontine dont le statut est `en_attente` ou `active`, THE TontineController SHALL mettre à jour la tontine et retourner une réponse 200 avec les données mises à jour.
2. IF l'admin tente de modifier une tontine dont le statut est `terminee` ou `archivee`, THEN THE TontineController SHALL retourner une réponse 422 avec le message "La tontine ne peut être modifiée que si son statut est 'en_attente' ou 'active'".
3. IF le champ `frequence` fourni ne fait pas partie des valeurs `hebdomadaire`, `mensuel`, `trimestriel`, THEN THE TontineController SHALL retourner une réponse 422.
4. IF le champ `statut` fourni ne fait pas partie des valeurs `en_attente`, `active`, `terminee`, `archivee`, THEN THE TontineController SHALL retourner une réponse 422.
5. IF le champ `montant_cotisation` fourni est inférieur ou égal à zéro, THEN THE TontineController SHALL retourner une réponse 422.
6. IF la tontine à modifier n'existe pas, THEN THE TontineController SHALL retourner une réponse 404.
7. IF un utilisateur avec le rôle `membre` tente de modifier une tontine, THEN THE API SHALL retourner une réponse 403.

---

### Exigence 5 : Suppression d'une tontine

**User Story :** En tant qu'admin, je veux supprimer une tontine terminée, afin de nettoyer les données obsolètes.

#### Critères d'acceptation

1. WHEN l'admin envoie une requête DELETE sur une tontine dont le `statut` est `terminee`, THE TontineController SHALL supprimer la tontine et retourner une réponse 200 avec un message de confirmation.
2. IF l'admin tente de supprimer une tontine dont le `statut` est `en_attente`, `active` ou `archivee`, THEN THE TontineController SHALL retourner une réponse 422 avec le message "La tontine ne peut être supprimée que si son statut est 'terminee'".
3. IF la tontine à supprimer n'existe pas, THEN THE TontineController SHALL retourner une réponse 404.
4. WHEN une tontine est supprimée, THE TontineController SHALL supprimer toutes les lignes correspondantes dans la table pivot `tontine_user` (cascade delete).
5. IF un utilisateur avec le rôle `membre` tente de supprimer une tontine, THEN THE API SHALL retourner une réponse 403.

---

### Exigence 6 : Assignation d'un membre à une tontine

**User Story :** En tant qu'admin, je veux assigner un membre existant à une tontine, afin de constituer le groupe de la tontine.

#### Critères d'acceptation

1. WHEN l'admin soumet une requête POST avec un `user_id` valide, un `ordre_passage` positif et une `date_adhesion` valide sur une tontine dont le statut est `en_attente` ou `active`, THE MembreTontineController SHALL créer une ligne dans la table pivot `tontine_user` et retourner une réponse 200 avec les données du membre et les informations de la liaison.
2. IF le `user_id` fourni ne correspond à aucun utilisateur existant, THEN THE MembreTontineController SHALL retourner une réponse 404.
3. IF le membre est déjà présent dans cette même tontine (ligne existante dans `tontine_user`), THEN THE MembreTontineController SHALL retourner une réponse 422 avec le message "Ce membre est déjà inscrit dans cette tontine".
4. IF le `ordre_passage` fourni est déjà utilisé par un autre membre dans la même tontine, THEN THE MembreTontineController SHALL retourner une réponse 422 avec un message indiquant que cet ordre de passage est déjà pris.
5. IF le `ordre_passage` fourni est inférieur ou égal à zéro, THEN THE MembreTontineController SHALL retourner une réponse 422.
6. IF la tontine cible n'existe pas, THEN THE MembreTontineController SHALL retourner une réponse 404.
7. IF la tontine cible a le statut `terminee` ou `archivee`, THEN THE MembreTontineController SHALL retourner une réponse 422 avec le message "L'ajout de membres n'est pas autorisé pour une tontine avec ce statut".
8. THE MembreTontineController SHALL enregistrer dans la table pivot `tontine_user` les champs `date_adhesion`, `ajoute_par` (user_id de l'admin authentifié) et `date_retrait` à `null`.
9. IF un utilisateur avec le rôle `membre` tente d'assigner un membre à une tontine, THEN THE API SHALL retourner une réponse 403.

---

### Exigence 7 : Retrait d'un membre d'une tontine

**User Story :** En tant qu'admin, je veux retirer un membre d'une tontine, afin de gérer les départs ou erreurs d'assignation.

#### Critères d'acceptation

1. WHEN l'admin envoie une requête DELETE sur l'assignation d'un membre existant dans une tontine, THE MembreTontineController SHALL supprimer la ligne correspondante dans la table pivot `tontine_user` et retourner une réponse 200 avec un message de confirmation.
2. THE MembreTontineController SHALL supprimer uniquement le lien entre ce membre et cette tontine, sans affecter les autres appartenances du membre à d'autres tontines.
3. IF le membre spécifié n'appartient pas à la tontine spécifiée (aucune ligne dans `tontine_user`), THEN THE MembreTontineController SHALL retourner une réponse 422 avec le message "Ce membre n'appartient pas à cette tontine".
4. IF le `user_id` fourni ne correspond à aucun utilisateur existant, THEN THE MembreTontineController SHALL retourner une réponse 404.
5. IF la tontine spécifiée n'existe pas, THEN THE MembreTontineController SHALL retourner une réponse 404.
6. IF un utilisateur avec le rôle `membre` tente de retirer un membre d'une tontine, THEN THE API SHALL retourner une réponse 403.

---

### Exigence 8 : Consultation des tontines par un membre

**User Story :** En tant que membre, je veux consulter toutes les tontines auxquelles j'appartiens et leurs participants, afin de suivre mes groupes d'épargne.

#### Critères d'acceptation

1. WHEN un membre authentifié envoie une requête GET sur son endpoint de tontines, THE MembreTontineViewController SHALL retourner une réponse 200 avec la liste de toutes les tontines auxquelles il appartient, incluant pour chaque tontine : `nom`, `description`, `montant_cotisation`, `frequence`, `date_debut`, `statut`, et la liste des membres (first_name, last_name, ordre_passage, date_adhesion).
2. WHEN un membre authentifié envoie une requête GET sur le détail d'une tontine à laquelle il appartient, THE MembreTontineViewController SHALL retourner une réponse 200 avec les données complètes de la tontine et la liste de ses membres.
3. IF le membre authentifié n'est inscrit à aucune tontine, THEN THE MembreTontineViewController SHALL retourner une réponse 200 avec un tableau vide.
4. IF un membre tente d'accéder au détail d'une tontine à laquelle il n'appartient pas, THEN THE API SHALL retourner une réponse 403 avec le message "Vous n'avez pas accès à cette tontine".
5. IF un utilisateur non authentifié tente d'accéder à cet endpoint, THEN THE API SHALL retourner une réponse 401.
6. THE MembreTontineViewController SHALL retourner uniquement les tontines auxquelles le membre est inscrit, sans exposer les autres tontines existantes.

---

### Exigence 9 : Appartenance multiple et unicité par tontine

**User Story :** En tant qu'admin, je veux qu'un membre puisse appartenir à plusieurs tontines simultanément, mais ne puisse pas être inscrit deux fois dans la même tontine, afin de garantir l'intégrité des données.

#### Critères d'acceptation

1. THE tontine_user SHALL autoriser un même `user_id` à apparaître dans plusieurs lignes avec des `tontine_id` différents.
2. THE tontine_user SHALL appliquer une contrainte d'unicité composite sur (`tontine_id`, `user_id`) pour interdire les doublons dans une même tontine.
3. WHEN l'admin assigne un membre à une tontine à laquelle il appartient déjà, THE MembreTontineController SHALL retourner une réponse 422 avec le message "Ce membre est déjà inscrit dans cette tontine".
4. WHEN l'admin retire un membre d'une tontine, THE MembreTontineController SHALL conserver les autres lignes du membre dans `tontine_user` pour ses autres tontines.

---

### Exigence 10 : Gestion des statuts de tontine

**User Story :** En tant qu'admin, je veux gérer le cycle de vie d'une tontine via ses statuts, afin de contrôler les opérations autorisées à chaque étape.

#### Critères d'acceptation

1. THE Tontine SHALL supporter exactement quatre statuts : `en_attente`, `active`, `terminee`, `archivee`.
2. WHEN une tontine est créée sans statut explicite, THE TontineController SHALL assigner le statut `en_attente`.
3. WHILE une tontine a le statut `en_attente` ou `active`, THE TontineController SHALL autoriser la modification de ses données.
4. WHILE une tontine a le statut `terminee` ou `archivee`, THE TontineController SHALL rejeter toute tentative de modification avec une réponse 422.
5. WHILE une tontine a le statut `en_attente` ou `active`, THE MembreTontineController SHALL autoriser l'ajout de membres.
6. WHILE une tontine a le statut `terminee` ou `archivee`, THE MembreTontineController SHALL rejeter toute tentative d'ajout de membre avec une réponse 422.
7. WHEN l'admin tente de supprimer une tontine, THE TontineController SHALL autoriser la suppression uniquement si le statut est `terminee`.
8. WHILE une tontine a le statut `archivee`, THE TontineController SHALL autoriser uniquement la lecture (accès en lecture seule).

---

### Exigence 11 : Ordre de passage

**User Story :** En tant qu'admin, je veux définir un ordre de passage pour chaque membre dans une tontine, afin d'organiser le cycle de rotation.

#### Critères d'acceptation

1. THE tontine_user SHALL stocker l'`ordre_passage` comme un entier positif non nul dans la table pivot.
2. THE tontine_user SHALL appliquer une contrainte d'unicité composite sur (`tontine_id`, `ordre_passage`) pour interdire deux membres avec le même ordre dans une même tontine.
3. THE MembreTontineController SHALL accepter des valeurs d'`ordre_passage` non consécutives (ex : 1, 5, 10 sont valides dans la même tontine).
4. IF le `ordre_passage` fourni est déjà utilisé dans la tontine cible, THEN THE MembreTontineController SHALL retourner une réponse 422 avec le message "Cet ordre de passage est déjà attribué dans cette tontine".
5. IF le `ordre_passage` fourni est inférieur ou égal à zéro, THEN THE MembreTontineController SHALL retourner une réponse 422.

---

### Exigence 12 : Historique d'adhésion

**User Story :** En tant qu'admin, je veux conserver l'historique des adhésions et retraits de membres, afin de tracer les changements de composition des tontines.

#### Critères d'acceptation

1. THE tontine_user SHALL stocker `date_adhesion` (date d'ajout du membre), `date_retrait` (nullable, date de retrait), et `ajoute_par` (user_id de l'admin ayant effectué l'assignation).
2. WHEN un membre est assigné à une tontine, THE MembreTontineController SHALL enregistrer la `date_adhesion` et l'`ajoute_par` dans la table pivot.
3. WHEN un membre est retiré d'une tontine, THE MembreTontineController SHALL enregistrer la `date_retrait` dans la ligne correspondante de la table pivot avant suppression logique, ou supprimer la ligne selon la politique de rétention choisie.
4. IF le champ `ajoute_par` ne correspond à aucun utilisateur admin existant, THEN THE MembreTontineController SHALL retourner une réponse 422.

---

### Exigence 13 : Sécurité et contrôle d'accès

**User Story :** En tant que responsable de l'application, je veux que les accès aux données des tontines soient strictement contrôlés par rôle, afin de protéger les informations sensibles.

#### Critères d'acceptation

1. THE API SHALL vérifier l'authentification via Sanctum sur tous les endpoints de gestion des tontines et retourner une réponse 401 pour toute requête non authentifiée.
2. THE API SHALL vérifier le rôle `admin` pour toutes les opérations CRUD sur les tontines et retourner une réponse 403 pour les utilisateurs avec le rôle `membre`.
3. WHEN un membre authentifié accède à l'endpoint de ses tontines, THE API SHALL filtrer les résultats pour ne retourner que les tontines auxquelles ce membre est inscrit dans `tontine_user`.
4. IF un membre tente d'accéder au détail d'une tontine dont il ne fait pas partie, THEN THE API SHALL retourner une réponse 403.
5. THE API SHALL interdire aux membres l'accès aux endpoints d'administration (création, modification, suppression de tontines, gestion des membres).
