# Bugfix Requirements Document

## Introduction

L'admin ne dispose d'aucun endpoint ni vue pour consulter la liste des membres de la tontine.
Concrètement, aucune route `/admin/membres` n'existe : toute tentative d'accès retourne une 404.
Ce manque empêche l'admin de suivre les adhésions, les positions de passage et le statut de paiement des membres.

La correction consiste à exposer un endpoint API sécurisé (`role:admin`) qui retourne, pour chaque membre,
les informations essentielles : identité, contact, type de tontine, montant total cotisé et position de passage.

> Note : la table `cotisations` n'existe pas encore. Le montant total cotisé sera calculé à partir des données
> disponibles (montant du type de tontine × nombre de périodes écoulées depuis `date_adhesion`) jusqu'à la
> création d'une vraie table de paiements.

---

## Bug Analysis

### Current Behavior (Defect)

1.1 WHEN un admin authentifié envoie `GET /api/admin/membres` THEN le système retourne une erreur 404 (route inexistante)

1.2 WHEN un admin consulte le tableau de bord THEN le système n'affiche aucune donnée sur les membres (nom, téléphone, email, statut paiement, type de tontine, montant cotisé, position de passage)

1.3 WHEN un admin souhaite filtrer ou trier les membres THEN le système ne propose aucune fonctionnalité de ce type

### Expected Behavior (Correct)

2.1 WHEN un admin authentifié envoie `GET /api/admin/membres` THEN le système SHALL retourner HTTP 200 avec la liste paginée des membres incluant : `nom_complet`, `phone`, `email`, `statut_paiement`, `type_tontine`, `montant_total_cotise`, `ordre_passage`

2.2 WHEN un admin consulte la liste des membres THEN le système SHALL calculer `statut_paiement` comme `payé` si le membre est à jour de ses cotisations, `en retard` sinon (basé sur `date_adhesion` et la fréquence de la tontine)

2.3 WHEN un admin consulte la liste des membres THEN le système SHALL calculer `montant_total_cotise` comme le montant du `TontineType` multiplié par le nombre de périodes écoulées depuis `date_adhesion`

2.4 WHEN un utilisateur non-admin envoie `GET /api/admin/membres` THEN le système SHALL retourner HTTP 403

### Unchanged Behavior (Regression Prevention)

3.1 WHEN un utilisateur s'inscrit via `POST /api/auth/register` THEN le système SHALL CONTINUE TO créer le compte et retourner un token Sanctum

3.2 WHEN un utilisateur se connecte via `POST /api/auth/login` THEN le système SHALL CONTINUE TO authentifier et retourner le profil avec les relations `tontine` et `tontineType`

3.3 WHEN un admin gère les types de tontine via `/api/admin/tontine-types` THEN le système SHALL CONTINUE TO appliquer les règles CRUD existantes

3.4 WHEN un membre authentifié accède à `GET /api/auth/me` THEN le système SHALL CONTINUE TO retourner son profil complet sans modification
