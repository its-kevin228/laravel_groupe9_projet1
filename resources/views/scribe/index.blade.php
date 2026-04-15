<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>TontinePro API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.9.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.9.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-admin-cycles" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-cycles">
                    <a href="#admin-cycles">Admin — Cycles</a>
                </li>
                                    <ul id="tocify-subheader-admin-cycles" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-cycles-GETapi-admin-tontines--tontine_id--cycles">
                                <a href="#admin-cycles-GETapi-admin-tontines--tontine_id--cycles">Liste des cycles d'une tontine</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-cycles-POSTapi-admin-tontines--tontine_id--cycles">
                                <a href="#admin-cycles-POSTapi-admin-tontines--tontine_id--cycles">Ouvrir un nouveau cycle</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-cycles-GETapi-admin-tontines--tontine_id--cycles--cycle_id-">
                                <a href="#admin-cycles-GETapi-admin-tontines--tontine_id--cycles--cycle_id-">Détail d'un cycle</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-cycles-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer">
                                <a href="#admin-cycles-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer">Fermer un cycle</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-dashboard-statistiques" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-dashboard-statistiques">
                    <a href="#admin-dashboard-statistiques">Admin — Dashboard Statistiques</a>
                </li>
                                    <ul id="tocify-subheader-admin-dashboard-statistiques" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-dashboard-statistiques-GETapi-admin-stats">
                                <a href="#admin-dashboard-statistiques-GETapi-admin-stats">Statistiques globales</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-dashboard-statistiques-GETapi-admin-stats-tontines--tontine_id-">
                                <a href="#admin-dashboard-statistiques-GETapi-admin-stats-tontines--tontine_id-">Statistiques d'une tontine</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-exclusion-de-membres" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-exclusion-de-membres">
                    <a href="#admin-exclusion-de-membres">Admin — Exclusion de membres</a>
                </li>
                                    <ul id="tocify-subheader-admin-exclusion-de-membres" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-exclusion-de-membres-GETapi-admin-membres-exclus">
                                <a href="#admin-exclusion-de-membres-GETapi-admin-membres-exclus">Liste des membres exclus</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-exclusion-de-membres-POSTapi-admin-membres--user_id--exclure">
                                <a href="#admin-exclusion-de-membres-POSTapi-admin-membres--user_id--exclure">Exclure un membre</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-exclusion-de-membres-POSTapi-admin-membres--user_id--reintegrer">
                                <a href="#admin-exclusion-de-membres-POSTapi-admin-membres--user_id--reintegrer">Réintégrer un membre exclu</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-export-pdf" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-export-pdf">
                    <a href="#admin-export-pdf">Admin — Export PDF</a>
                </li>
                                    <ul id="tocify-subheader-admin-export-pdf" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-export-pdf-GETapi-admin-tontines--tontine_id--export-membres">
                                <a href="#admin-export-pdf-GETapi-admin-tontines--tontine_id--export-membres">Export liste des membres</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-export-pdf-GETapi-admin-tontines--tontine_id--export-paiements">
                                <a href="#admin-export-pdf-GETapi-admin-tontines--tontine_id--export-paiements">Export rapport paiements</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-export-pdf-GETapi-admin-tontines--tontine_id--export-historique">
                                <a href="#admin-export-pdf-GETapi-admin-tontines--tontine_id--export-historique">Export historique tontine</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-historique-audit" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-historique-audit">
                    <a href="#admin-historique-audit">Admin — Historique & Audit</a>
                </li>
                                    <ul id="tocify-subheader-admin-historique-audit" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-historique-audit-GETapi-admin-historique-paiements">
                                <a href="#admin-historique-audit-GETapi-admin-historique-paiements">Historique global des paiements</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-historique-audit-GETapi-admin-historique-beneficiaires">
                                <a href="#admin-historique-audit-GETapi-admin-historique-beneficiaires">Bénéficiaires passés</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-historique-audit-GETapi-admin-historique-journal">
                                <a href="#admin-historique-audit-GETapi-admin-historique-journal">Journal des actions admin</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-historique-audit-GETapi-admin-historique-actions">
                                <a href="#admin-historique-audit-GETapi-admin-historique-actions">Actions disponibles dans le journal</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-invitations" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-invitations">
                    <a href="#admin-invitations">Admin — Invitations</a>
                </li>
                                    <ul id="tocify-subheader-admin-invitations" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-invitations-GETapi-admin-tontines--tontine_id--invitations">
                                <a href="#admin-invitations-GETapi-admin-tontines--tontine_id--invitations">Liste des invitations d'une tontine</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-invitations-POSTapi-admin-tontines--tontine_id--invitations">
                                <a href="#admin-invitations-POSTapi-admin-tontines--tontine_id--invitations">Envoyer une invitation</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-invitations-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-">
                                <a href="#admin-invitations-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-">Annuler une invitation</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-membres" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-membres">
                    <a href="#admin-membres">Admin — Membres</a>
                </li>
                                    <ul id="tocify-subheader-admin-membres" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-membres-GETapi-admin-membres">
                                <a href="#admin-membres-GETapi-admin-membres">Liste des membres</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-notifications" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-notifications">
                    <a href="#admin-notifications">Admin — Notifications</a>
                </li>
                                    <ul id="tocify-subheader-admin-notifications" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-notifications-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel">
                                <a href="#admin-notifications-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel">Envoyer un rappel de paiement</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-notifications-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard">
                                <a href="#admin-notifications-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard">Envoyer une alerte de retard</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-notifications-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire">
                                <a href="#admin-notifications-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire">Notifier le bénéficiaire</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-notifications-GETapi-notifications">
                                <a href="#admin-notifications-GETapi-notifications">Notifications reçues par le membre connecté</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-notifications-PATCHapi-notifications--id--lue">
                                <a href="#admin-notifications-PATCHapi-notifications--id--lue">Marquer une notification comme lue</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-notifications-PATCHapi-notifications-toutes-lues">
                                <a href="#admin-notifications-PATCHapi-notifications-toutes-lues">Marquer toutes les notifications comme lues</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-paiements" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-paiements">
                    <a href="#admin-paiements">Admin — Paiements</a>
                </li>
                                    <ul id="tocify-subheader-admin-paiements" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-paiements-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">
                                <a href="#admin-paiements-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">Liste des paiements d'un cycle</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-paiements-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">
                                <a href="#admin-paiements-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">Enregistrer un paiement</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-paiements-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-">
                                <a href="#admin-paiements-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-">Statut de paiement d'un membre pour un cycle</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-admin-types-de-tontine-par-membre" class="tocify-header">
                <li class="tocify-item level-1" data-unique="admin-types-de-tontine-par-membre">
                    <a href="#admin-types-de-tontine-par-membre">Admin — Types de Tontine par Membre</a>
                </li>
                                    <ul id="tocify-subheader-admin-types-de-tontine-par-membre" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="admin-types-de-tontine-par-membre-GETapi-admin-membres--user_id--tontine-types">
                                <a href="#admin-types-de-tontine-par-membre-GETapi-admin-membres--user_id--tontine-types">Types d'un membre</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-types-de-tontine-par-membre-POSTapi-admin-membres--user_id--tontine-types">
                                <a href="#admin-types-de-tontine-par-membre-POSTapi-admin-membres--user_id--tontine-types">Assigner un type à un membre</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="admin-types-de-tontine-par-membre-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-">
                                <a href="#admin-types-de-tontine-par-membre-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-">Retirer un type d'un membre</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-authentification" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentification">
                    <a href="#authentification">Authentification</a>
                </li>
                                    <ul id="tocify-subheader-authentification" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentification-GETapi-auth-register-form">
                                <a href="#authentification-GETapi-auth-register-form">Données du formulaire d'inscription</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentification-POSTapi-auth-register">
                                <a href="#authentification-POSTapi-auth-register">Inscription</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentification-POSTapi-auth-login">
                                <a href="#authentification-POSTapi-auth-login">Connexion</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentification-POSTapi-auth-logout">
                                <a href="#authentification-POSTapi-auth-logout">Déconnexion</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentification-GETapi-auth-me">
                                <a href="#authentification-GETapi-auth-me">Profil connecté</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-invitations-reponse" class="tocify-header">
                <li class="tocify-item level-1" data-unique="invitations-reponse">
                    <a href="#invitations-reponse">Invitations — Réponse</a>
                </li>
                                    <ul id="tocify-subheader-invitations-reponse" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="invitations-reponse-GETapi-invitations--token-">
                                <a href="#invitations-reponse-GETapi-invitations--token-">Consulter une invitation</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="invitations-reponse-POSTapi-invitations--token--accepter">
                                <a href="#invitations-reponse-POSTapi-invitations--token--accepter">Accepter une invitation</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="invitations-reponse-POSTapi-invitations--token--refuser">
                                <a href="#invitations-reponse-POSTapi-invitations--token--refuser">Refuser une invitation</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-membre-tableau-de-bord" class="tocify-header">
                <li class="tocify-item level-1" data-unique="membre-tableau-de-bord">
                    <a href="#membre-tableau-de-bord">Membre — Tableau de bord</a>
                </li>
                                    <ul id="tocify-subheader-membre-tableau-de-bord" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="membre-tableau-de-bord-GETapi-dashboard">
                                <a href="#membre-tableau-de-bord-GETapi-dashboard">Tableau de bord global du membre</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="membre-tableau-de-bord-GETapi-dashboard-tontines--tontine_id-">
                                <a href="#membre-tableau-de-bord-GETapi-dashboard-tontines--tontine_id-">Tableau de bord pour une tontine spécifique</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="membre-tableau-de-bord-GETapi-dashboard-tontines--tontine_id--historique">
                                <a href="#membre-tableau-de-bord-GETapi-dashboard-tontines--tontine_id--historique">Historique complet des paiements du membre pour une tontine</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-types-de-tontine" class="tocify-header">
                <li class="tocify-item level-1" data-unique="types-de-tontine">
                    <a href="#types-de-tontine">Types de Tontine</a>
                </li>
                                    <ul id="tocify-subheader-types-de-tontine" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="types-de-tontine-GETapi-tontine-types">
                                <a href="#types-de-tontine-GETapi-tontine-types">Liste des types</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="types-de-tontine-GETapi-tontine-types--tontineType_id-">
                                <a href="#types-de-tontine-GETapi-tontine-types--tontineType_id-">Détail d'un type</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="types-de-tontine-POSTapi-admin-tontine-types">
                                <a href="#types-de-tontine-POSTapi-admin-tontine-types">Créer un type</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="types-de-tontine-PUTapi-admin-tontine-types--tontineType_id-">
                                <a href="#types-de-tontine-PUTapi-admin-tontine-types--tontineType_id-">Modifier un type</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="types-de-tontine-DELETEapi-admin-tontine-types--tontineType_id-">
                                <a href="#types-de-tontine-DELETEapi-admin-tontine-types--tontineType_id-">Supprimer un type</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: April 14, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Documentation complète de l'API TontinePro — Authentification, gestion des tontines, membres et cotisations.</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header with the value <strong><code>"Bearer {VOTRE_TOKEN_SANCTUM}"</code></strong>.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>Obtenez votre token via <b>POST /api/auth/login</b> puis passez-le en header : <code>Authorization: Bearer {token}</code></p>

        <h1 id="admin-cycles">Admin — Cycles</h1>

    

                                <h2 id="admin-cycles-GETapi-admin-tontines--tontine_id--cycles">Liste des cycles d&#039;une tontine</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-admin-tontines--tontine_id--cycles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/tontines/16/cycles" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/cycles"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-tontines--tontine_id--cycles">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;numero_cycle&quot;: 1,
        &quot;statut&quot;: &quot;ferme&quot;,
        &quot;date_ouverture&quot;: &quot;2026-01-01&quot;,
        &quot;date_fermeture&quot;: &quot;2026-01-31&quot;,
        &quot;beneficiaire&quot;: {
            &quot;id&quot;: 3,
            &quot;first_name&quot;: &quot;Alice&quot;,
            &quot;last_name&quot;: &quot;Dupont&quot;
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-tontines--tontine_id--cycles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-tontines--tontine_id--cycles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-tontines--tontine_id--cycles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-tontines--tontine_id--cycles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-tontines--tontine_id--cycles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-tontines--tontine_id--cycles" data-method="GET"
      data-path="api/admin/tontines/{tontine_id}/cycles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-tontines--tontine_id--cycles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-tontines--tontine_id--cycles"
                    onclick="tryItOut('GETapi-admin-tontines--tontine_id--cycles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-tontines--tontine_id--cycles"
                    onclick="cancelTryOut('GETapi-admin-tontines--tontine_id--cycles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-tontines--tontine_id--cycles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/tontines/{tontine_id}/cycles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-tontines--tontine_id--cycles"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-cycles-POSTapi-admin-tontines--tontine_id--cycles">Ouvrir un nouveau cycle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Crée le prochain cycle pour la tontine. Le bénéficiaire est déterminé
automatiquement selon l'ordre_passage des membres.
Un seul cycle ouvert est autorisé par tontine à la fois.</p>

<span id="example-requests-POSTapi-admin-tontines--tontine_id--cycles">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/tontines/16/cycles" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"date_ouverture\": \"2026-02-01\",
    \"date_fermeture\": \"2052-05-07\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/cycles"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "date_ouverture": "2026-02-01",
    "date_fermeture": "2052-05-07"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-tontines--tontine_id--cycles">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 2,
    &quot;numero_cycle&quot;: 2,
    &quot;statut&quot;: &quot;ouvert&quot;,
    &quot;date_ouverture&quot;: &quot;2026-02-01&quot;,
    &quot;beneficiaire&quot;: {
        &quot;id&quot;: 5,
        &quot;first_name&quot;: &quot;Bob&quot;,
        &quot;last_name&quot;: &quot;Martin&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-tontines--tontine_id--cycles" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-tontines--tontine_id--cycles"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-tontines--tontine_id--cycles"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-tontines--tontine_id--cycles" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-tontines--tontine_id--cycles">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-tontines--tontine_id--cycles" data-method="POST"
      data-path="api/admin/tontines/{tontine_id}/cycles"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-tontines--tontine_id--cycles', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-tontines--tontine_id--cycles"
                    onclick="tryItOut('POSTapi-admin-tontines--tontine_id--cycles');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-tontines--tontine_id--cycles"
                    onclick="cancelTryOut('POSTapi-admin-tontines--tontine_id--cycles');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-tontines--tontine_id--cycles"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/tontines/{tontine_id}/cycles</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-tontines--tontine_id--cycles"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_ouverture</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_ouverture"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles"
               value="2026-02-01"
               data-component="body">
    <br>
<p>Date d'ouverture (YYYY-MM-DD, défaut: aujourd'hui). Example: <code>2026-02-01</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_fermeture</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_fermeture"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles"
               value="2052-05-07"
               data-component="body">
    <br>
<p>Must be a valid date. Must be a date after or equal to <code>date_ouverture</code>. Example: <code>2052-05-07</code></p>
        </div>
        </form>

                    <h2 id="admin-cycles-GETapi-admin-tontines--tontine_id--cycles--cycle_id-">Détail d&#039;un cycle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-admin-tontines--tontine_id--cycles--cycle_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/tontines/16/cycles/16" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/cycles/16"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-tontines--tontine_id--cycles--cycle_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;numero_cycle&quot;: 1,
    &quot;statut&quot;: &quot;ouvert&quot;,
    &quot;beneficiaire&quot;: {
        &quot;id&quot;: 3,
        &quot;first_name&quot;: &quot;Alice&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-tontines--tontine_id--cycles--cycle_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-tontines--tontine_id--cycles--cycle_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-tontines--tontine_id--cycles--cycle_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-tontines--tontine_id--cycles--cycle_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-tontines--tontine_id--cycles--cycle_id-" data-method="GET"
      data-path="api/admin/tontines/{tontine_id}/cycles/{cycle_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-tontines--tontine_id--cycles--cycle_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
                    onclick="tryItOut('GETapi-admin-tontines--tontine_id--cycles--cycle_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
                    onclick="cancelTryOut('GETapi-admin-tontines--tontine_id--cycles--cycle_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/tontines/{tontine_id}/cycles/{cycle_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle_id"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the cycle. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id-"
               value="1"
               data-component="url">
    <br>
<p>ID du cycle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-cycles-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer">Fermer un cycle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Ferme le cycle actif et prépare automatiquement le prochain bénéficiaire.
La fermeture déclenche le passage au cycle suivant (le prochain cycle
devra être ouvert manuellement via POST).</p>

<span id="example-requests-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/tontines/16/cycles/16/fermer" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"date_fermeture\": \"2026-01-31\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/cycles/16/fermer"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "date_fermeture": "2026-01-31"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;cycle_ferme&quot;: {
        &quot;id&quot;: 1,
        &quot;numero_cycle&quot;: 1,
        &quot;statut&quot;: &quot;ferme&quot;,
        &quot;date_fermeture&quot;: &quot;2026-01-31&quot;
    },
    &quot;prochain_beneficiaire&quot;: {
        &quot;id&quot;: 5,
        &quot;first_name&quot;: &quot;Bob&quot;,
        &quot;last_name&quot;: &quot;Martin&quot;,
        &quot;ordre_passage&quot;: 2
    },
    &quot;message&quot;: &quot;Cycle 1 ferm&eacute;. Prochain b&eacute;n&eacute;ficiaire : Bob Martin (ordre 2).&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer" data-method="POST"
      data-path="api/admin/tontines/{tontine_id}/cycles/{cycle_id}/fermer"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
                    onclick="tryItOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
                    onclick="cancelTryOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/tontines/{tontine_id}/cycles/{cycle_id}/fermer</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
               value="16"
               data-component="url">
    <br>
<p>The ID of the cycle. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
               value="1"
               data-component="url">
    <br>
<p>ID du cycle à fermer. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_fermeture</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_fermeture"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--fermer"
               value="2026-01-31"
               data-component="body">
    <br>
<p>Date de fermeture (YYYY-MM-DD, défaut: aujourd'hui). Example: <code>2026-01-31</code></p>
        </div>
        </form>

                <h1 id="admin-dashboard-statistiques">Admin — Dashboard Statistiques</h1>

    

                                <h2 id="admin-dashboard-statistiques-GETapi-admin-stats">Statistiques globales</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retourne un résumé complet de toutes les tontines :
membres, cotisations, retards, cycles en cours.</p>

<span id="example-requests-GETapi-admin-stats">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/stats" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/stats"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-stats">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;membres&quot;: {
        &quot;total&quot;: 24,
        &quot;actifs&quot;: 20
    },
    &quot;tontines&quot;: {
        &quot;total&quot;: 3,
        &quot;actives&quot;: 2,
        &quot;en_attente&quot;: 1,
        &quot;terminees&quot;: 0
    },
    &quot;cotisations&quot;: {
        &quot;total_collecte&quot;: &quot;480000.00&quot;,
        &quot;total_attendu&quot;: &quot;600000.00&quot;,
        &quot;taux_recouvrement&quot;: &quot;80.00&quot;
    },
    &quot;paiements_en_retard&quot;: {
        &quot;nombre&quot;: 4,
        &quot;montant&quot;: &quot;20000.00&quot;
    },
    &quot;cycles_en_cours&quot;: [
        {
            &quot;tontine&quot;: &quot;Tontine Solidarit&eacute;&quot;,
            &quot;cycle_numero&quot;: 2,
            &quot;beneficiaire&quot;: &quot;Alice Dupont&quot;,
            &quot;ont_paye&quot;: 18,
            &quot;en_retard&quot;: 2,
            &quot;date_fermeture&quot;: &quot;2026-02-28&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-stats" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-stats"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-stats"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-stats" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-stats">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-stats" data-method="GET"
      data-path="api/admin/stats"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-stats', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-stats"
                    onclick="tryItOut('GETapi-admin-stats');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-stats"
                    onclick="cancelTryOut('GETapi-admin-stats');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-stats"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/stats</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-stats"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-stats"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="admin-dashboard-statistiques-GETapi-admin-stats-tontines--tontine_id-">Statistiques d&#039;une tontine</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Détail complet des statistiques pour une tontine spécifique.</p>

<span id="example-requests-GETapi-admin-stats-tontines--tontine_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/stats/tontines/16" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/stats/tontines/16"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-stats-tontines--tontine_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;tontine&quot;: {
        &quot;id&quot;: 1,
        &quot;nom&quot;: &quot;Tontine Solidarit&eacute;&quot;,
        &quot;statut&quot;: &quot;active&quot;
    },
    &quot;membres&quot;: {
        &quot;total&quot;: 8,
        &quot;liste&quot;: []
    },
    &quot;cycles&quot;: {
        &quot;total&quot;: 3,
        &quot;fermes&quot;: 2,
        &quot;en_cours&quot;: 1
    },
    &quot;cotisations&quot;: {
        &quot;total_collecte&quot;: &quot;160000.00&quot;,
        &quot;total_attendu&quot;: &quot;200000.00&quot;,
        &quot;taux_recouvrement&quot;: &quot;80.00&quot;
    },
    &quot;paiements_en_retard&quot;: {
        &quot;nombre&quot;: 2,
        &quot;membres&quot;: []
    },
    &quot;cycle_actif&quot;: {
        &quot;numero_cycle&quot;: 3,
        &quot;beneficiaire&quot;: &quot;Bob Martin&quot;
    },
    &quot;historique_cycles&quot;: []
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-stats-tontines--tontine_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-stats-tontines--tontine_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-stats-tontines--tontine_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-stats-tontines--tontine_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-stats-tontines--tontine_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-stats-tontines--tontine_id-" data-method="GET"
      data-path="api/admin/stats/tontines/{tontine_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-stats-tontines--tontine_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-stats-tontines--tontine_id-"
                    onclick="tryItOut('GETapi-admin-stats-tontines--tontine_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-stats-tontines--tontine_id-"
                    onclick="cancelTryOut('GETapi-admin-stats-tontines--tontine_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-stats-tontines--tontine_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/stats/tontines/{tontine_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-stats-tontines--tontine_id-"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-stats-tontines--tontine_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-stats-tontines--tontine_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-stats-tontines--tontine_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-admin-stats-tontines--tontine_id-"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="admin-exclusion-de-membres">Admin — Exclusion de membres</h1>

    

                                <h2 id="admin-exclusion-de-membres-GETapi-admin-membres-exclus">Liste des membres exclus</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-admin-membres-exclus">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/membres/exclus" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/membres/exclus"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-membres-exclus">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 3,
        &quot;nom_complet&quot;: &quot;Alice Dupont&quot;,
        &quot;phone&quot;: &quot;+22890000000&quot;,
        &quot;exclu_at&quot;: &quot;2026-04-14&quot;,
        &quot;raison_exclusion&quot;: &quot;Non-paiement r&eacute;p&eacute;t&eacute;&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-membres-exclus" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-membres-exclus"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-membres-exclus"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-membres-exclus" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-membres-exclus">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-membres-exclus" data-method="GET"
      data-path="api/admin/membres/exclus"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-membres-exclus', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-membres-exclus"
                    onclick="tryItOut('GETapi-admin-membres-exclus');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-membres-exclus"
                    onclick="cancelTryOut('GETapi-admin-membres-exclus');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-membres-exclus"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/membres/exclus</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-membres-exclus"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-membres-exclus"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-membres-exclus"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="admin-exclusion-de-membres-POSTapi-admin-membres--user_id--exclure">Exclure un membre</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Bloque l'accès d'un membre à la plateforme.
Un membre exclu ne peut plus effectuer aucune action.</p>

<span id="example-requests-POSTapi-admin-membres--user_id--exclure">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/membres/16/exclure" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"raison\": \"Non-paiement répété\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/membres/16/exclure"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "raison": "Non-paiement répété"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-membres--user_id--exclure">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Alice Dupont a &eacute;t&eacute; exclu(e) avec succ&egrave;s.&quot;,
    &quot;membre&quot;: {
        &quot;id&quot;: 3,
        &quot;nom_complet&quot;: &quot;Alice Dupont&quot;,
        &quot;exclu_at&quot;: &quot;2026-04-14&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-membres--user_id--exclure" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-membres--user_id--exclure"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-membres--user_id--exclure"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-membres--user_id--exclure" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-membres--user_id--exclure">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-membres--user_id--exclure" data-method="POST"
      data-path="api/admin/membres/{user_id}/exclure"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-membres--user_id--exclure', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-membres--user_id--exclure"
                    onclick="tryItOut('POSTapi-admin-membres--user_id--exclure');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-membres--user_id--exclure"
                    onclick="cancelTryOut('POSTapi-admin-membres--user_id--exclure');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-membres--user_id--exclure"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/membres/{user_id}/exclure</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-membres--user_id--exclure"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-membres--user_id--exclure"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-membres--user_id--exclure"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-admin-membres--user_id--exclure"
               value="16"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user"                data-endpoint="POSTapi-admin-membres--user_id--exclure"
               value="3"
               data-component="url">
    <br>
<p>ID du membre à exclure. Example: <code>3</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>raison</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="raison"                data-endpoint="POSTapi-admin-membres--user_id--exclure"
               value="Non-paiement répété"
               data-component="body">
    <br>
<p>Raison de l'exclusion. Example: <code>Non-paiement répété</code></p>
        </div>
        </form>

                    <h2 id="admin-exclusion-de-membres-POSTapi-admin-membres--user_id--reintegrer">Réintégrer un membre exclu</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Restaure l'accès d'un membre précédemment exclu.</p>

<span id="example-requests-POSTapi-admin-membres--user_id--reintegrer">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/membres/16/reintegrer" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/membres/16/reintegrer"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-membres--user_id--reintegrer">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Alice Dupont a &eacute;t&eacute; r&eacute;int&eacute;gr&eacute;(e) avec succ&egrave;s.&quot;,
    &quot;membre&quot;: {
        &quot;id&quot;: 3,
        &quot;nom_complet&quot;: &quot;Alice Dupont&quot;,
        &quot;exclu_at&quot;: null
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-membres--user_id--reintegrer" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-membres--user_id--reintegrer"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-membres--user_id--reintegrer"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-membres--user_id--reintegrer" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-membres--user_id--reintegrer">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-membres--user_id--reintegrer" data-method="POST"
      data-path="api/admin/membres/{user_id}/reintegrer"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-membres--user_id--reintegrer', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-membres--user_id--reintegrer"
                    onclick="tryItOut('POSTapi-admin-membres--user_id--reintegrer');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-membres--user_id--reintegrer"
                    onclick="cancelTryOut('POSTapi-admin-membres--user_id--reintegrer');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-membres--user_id--reintegrer"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/membres/{user_id}/reintegrer</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-membres--user_id--reintegrer"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-membres--user_id--reintegrer"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-membres--user_id--reintegrer"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-admin-membres--user_id--reintegrer"
               value="16"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user"                data-endpoint="POSTapi-admin-membres--user_id--reintegrer"
               value="3"
               data-component="url">
    <br>
<p>ID du membre à réintégrer. Example: <code>3</code></p>
            </div>
                    </form>

                <h1 id="admin-export-pdf">Admin — Export PDF</h1>

    

                                <h2 id="admin-export-pdf-GETapi-admin-tontines--tontine_id--export-membres">Export liste des membres</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Génère un PDF avec la liste complète des membres d'une tontine.</p>

<span id="example-requests-GETapi-admin-tontines--tontine_id--export-membres">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/tontines/16/export/membres" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/export/membres"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-tontines--tontine_id--export-membres">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">file Le fichier PDF est retourn&eacute; en t&eacute;l&eacute;chargement.</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-tontines--tontine_id--export-membres" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-tontines--tontine_id--export-membres"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-tontines--tontine_id--export-membres"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-tontines--tontine_id--export-membres" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-tontines--tontine_id--export-membres">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-tontines--tontine_id--export-membres" data-method="GET"
      data-path="api/admin/tontines/{tontine_id}/export/membres"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-tontines--tontine_id--export-membres', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-tontines--tontine_id--export-membres"
                    onclick="tryItOut('GETapi-admin-tontines--tontine_id--export-membres');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-tontines--tontine_id--export-membres"
                    onclick="cancelTryOut('GETapi-admin-tontines--tontine_id--export-membres');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-tontines--tontine_id--export-membres"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/tontines/{tontine_id}/export/membres</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-tontines--tontine_id--export-membres"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-tontines--tontine_id--export-membres"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-tontines--tontine_id--export-membres"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-tontines--tontine_id--export-membres"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-admin-tontines--tontine_id--export-membres"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-export-pdf-GETapi-admin-tontines--tontine_id--export-paiements">Export rapport paiements</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Génère un PDF avec le rapport des paiements d'une tontine.
Peut être filtré par cycle.</p>

<span id="example-requests-GETapi-admin-tontines--tontine_id--export-paiements">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/tontines/16/export/paiements?cycle_id=1" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/export/paiements"
);

const params = {
    "cycle_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-tontines--tontine_id--export-paiements">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">file Le fichier PDF est retourn&eacute; en t&eacute;l&eacute;chargement.</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-tontines--tontine_id--export-paiements" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-tontines--tontine_id--export-paiements"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-tontines--tontine_id--export-paiements"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-tontines--tontine_id--export-paiements" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-tontines--tontine_id--export-paiements">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-tontines--tontine_id--export-paiements" data-method="GET"
      data-path="api/admin/tontines/{tontine_id}/export/paiements"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-tontines--tontine_id--export-paiements', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-tontines--tontine_id--export-paiements"
                    onclick="tryItOut('GETapi-admin-tontines--tontine_id--export-paiements');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-tontines--tontine_id--export-paiements"
                    onclick="cancelTryOut('GETapi-admin-tontines--tontine_id--export-paiements');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-tontines--tontine_id--export-paiements"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/tontines/{tontine_id}/export/paiements</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-tontines--tontine_id--export-paiements"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-tontines--tontine_id--export-paiements"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-tontines--tontine_id--export-paiements"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-tontines--tontine_id--export-paiements"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-admin-tontines--tontine_id--export-paiements"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle_id"                data-endpoint="GETapi-admin-tontines--tontine_id--export-paiements"
               value="1"
               data-component="query">
    <br>
<p>Filtrer par cycle. Example: <code>1</code></p>
            </div>
                </form>

                    <h2 id="admin-export-pdf-GETapi-admin-tontines--tontine_id--export-historique">Export historique tontine</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Génère un PDF avec l'historique complet d'une tontine :
cycles, bénéficiaires, statistiques de collecte.</p>

<span id="example-requests-GETapi-admin-tontines--tontine_id--export-historique">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/tontines/16/export/historique" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/export/historique"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-tontines--tontine_id--export-historique">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">file Le fichier PDF est retourn&eacute; en t&eacute;l&eacute;chargement.</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-tontines--tontine_id--export-historique" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-tontines--tontine_id--export-historique"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-tontines--tontine_id--export-historique"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-tontines--tontine_id--export-historique" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-tontines--tontine_id--export-historique">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-tontines--tontine_id--export-historique" data-method="GET"
      data-path="api/admin/tontines/{tontine_id}/export/historique"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-tontines--tontine_id--export-historique', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-tontines--tontine_id--export-historique"
                    onclick="tryItOut('GETapi-admin-tontines--tontine_id--export-historique');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-tontines--tontine_id--export-historique"
                    onclick="cancelTryOut('GETapi-admin-tontines--tontine_id--export-historique');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-tontines--tontine_id--export-historique"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/tontines/{tontine_id}/export/historique</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-tontines--tontine_id--export-historique"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-tontines--tontine_id--export-historique"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-tontines--tontine_id--export-historique"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-tontines--tontine_id--export-historique"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-admin-tontines--tontine_id--export-historique"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="admin-historique-audit">Admin — Historique & Audit</h1>

    

                                <h2 id="admin-historique-audit-GETapi-admin-historique-paiements">Historique global des paiements</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Tous les paiements enregistrés, filtrables par tontine, statut, période.</p>

<span id="example-requests-GETapi-admin-historique-paiements">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/historique/paiements?tontine_id=1&amp;statut=paye&amp;date_debut=2026-01-01&amp;date_fin=2026-12-31&amp;per_page=20" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/historique/paiements"
);

const params = {
    "tontine_id": "1",
    "statut": "paye",
    "date_debut": "2026-01-01",
    "date_fin": "2026-12-31",
    "per_page": "20",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-historique-paiements">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;montant&quot;: &quot;5000.00&quot;,
            &quot;statut&quot;: &quot;paye&quot;,
            &quot;paid_at&quot;: &quot;2026-01-10&quot;,
            &quot;membre&quot;: {
                &quot;id&quot;: 3,
                &quot;nom_complet&quot;: &quot;Alice Dupont&quot;
            },
            &quot;cycle&quot;: {
                &quot;numero_cycle&quot;: 1,
                &quot;tontine&quot;: &quot;Tontine Solidarit&eacute;&quot;
            },
            &quot;enregistre_par&quot;: {
                &quot;nom_complet&quot;: &quot;Admin Test&quot;
            }
        }
    ],
    &quot;total&quot;: 42,
    &quot;current_page&quot;: 1
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-historique-paiements" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-historique-paiements"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-historique-paiements"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-historique-paiements" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-historique-paiements">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-historique-paiements" data-method="GET"
      data-path="api/admin/historique/paiements"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-historique-paiements', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-historique-paiements"
                    onclick="tryItOut('GETapi-admin-historique-paiements');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-historique-paiements"
                    onclick="cancelTryOut('GETapi-admin-historique-paiements');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-historique-paiements"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/historique/paiements</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-historique-paiements"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-historique-paiements"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-historique-paiements"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-historique-paiements"
               value="1"
               data-component="query">
    <br>
<p>Filtrer par tontine. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>statut</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="statut"                data-endpoint="GETapi-admin-historique-paiements"
               value="paye"
               data-component="query">
    <br>
<p>Filtrer par statut (paye|en_retard). Example: <code>paye</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date_debut</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_debut"                data-endpoint="GETapi-admin-historique-paiements"
               value="2026-01-01"
               data-component="query">
    <br>
<p>Date de début (YYYY-MM-DD). Example: <code>2026-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date_fin</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_fin"                data-endpoint="GETapi-admin-historique-paiements"
               value="2026-12-31"
               data-component="query">
    <br>
<p>Date de fin (YYYY-MM-DD). Example: <code>2026-12-31</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-historique-paiements"
               value="20"
               data-component="query">
    <br>
<p>Résultats par page (défaut: 20). Example: <code>20</code></p>
            </div>
                </form>

                    <h2 id="admin-historique-audit-GETapi-admin-historique-beneficiaires">Bénéficiaires passés</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Liste tous les cycles fermés avec leur bénéficiaire, filtrables par tontine.</p>

<span id="example-requests-GETapi-admin-historique-beneficiaires">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/historique/beneficiaires?tontine_id=1" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/historique/beneficiaires"
);

const params = {
    "tontine_id": "1",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-historique-beneficiaires">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;tontine&quot;: &quot;Tontine Solidarit&eacute;&quot;,
        &quot;cycle_numero&quot;: 1,
        &quot;beneficiaire&quot;: &quot;Alice Dupont&quot;,
        &quot;ordre_passage&quot;: 1,
        &quot;date_ouverture&quot;: &quot;2026-01-01&quot;,
        &quot;date_fermeture&quot;: &quot;2026-01-31&quot;,
        &quot;total_collecte&quot;: &quot;40000.00&quot;,
        &quot;taux_participation&quot;: &quot;100.00&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-historique-beneficiaires" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-historique-beneficiaires"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-historique-beneficiaires"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-historique-beneficiaires" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-historique-beneficiaires">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-historique-beneficiaires" data-method="GET"
      data-path="api/admin/historique/beneficiaires"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-historique-beneficiaires', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-historique-beneficiaires"
                    onclick="tryItOut('GETapi-admin-historique-beneficiaires');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-historique-beneficiaires"
                    onclick="cancelTryOut('GETapi-admin-historique-beneficiaires');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-historique-beneficiaires"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/historique/beneficiaires</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-historique-beneficiaires"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-historique-beneficiaires"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-historique-beneficiaires"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-historique-beneficiaires"
               value="1"
               data-component="query">
    <br>
<p>Filtrer par tontine. Example: <code>1</code></p>
            </div>
                </form>

                    <h2 id="admin-historique-audit-GETapi-admin-historique-journal">Journal des actions admin</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Toutes les actions enregistrées dans le journal d'audit.</p>

<span id="example-requests-GETapi-admin-historique-journal">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/historique/journal?action=paiement.enregistre&amp;user_id=1&amp;date_debut=2026-01-01&amp;date_fin=2026-12-31&amp;per_page=30" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/historique/journal"
);

const params = {
    "action": "paiement.enregistre",
    "user_id": "1",
    "date_debut": "2026-01-01",
    "date_fin": "2026-12-31",
    "per_page": "30",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-historique-journal">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;action&quot;: &quot;paiement.enregistre&quot;,
            &quot;entite_type&quot;: &quot;Payment&quot;,
            &quot;entite_id&quot;: 5,
            &quot;details&quot;: {
                &quot;tontine_nom&quot;: &quot;Tontine Solidarit&eacute;&quot;,
                &quot;montant&quot;: 5000
            },
            &quot;admin&quot;: &quot;Admin Test&quot;,
            &quot;ip_address&quot;: &quot;127.0.0.1&quot;,
            &quot;created_at&quot;: &quot;2026-01-10T08:30:00&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-historique-journal" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-historique-journal"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-historique-journal"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-historique-journal" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-historique-journal">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-historique-journal" data-method="GET"
      data-path="api/admin/historique/journal"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-historique-journal', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-historique-journal"
                    onclick="tryItOut('GETapi-admin-historique-journal');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-historique-journal"
                    onclick="cancelTryOut('GETapi-admin-historique-journal');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-historique-journal"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/historique/journal</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-historique-journal"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-historique-journal"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-historique-journal"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>action</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="action"                data-endpoint="GETapi-admin-historique-journal"
               value="paiement.enregistre"
               data-component="query">
    <br>
<p>Filtrer par type d'action. Example: <code>paiement.enregistre</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="GETapi-admin-historique-journal"
               value="1"
               data-component="query">
    <br>
<p>Filtrer par admin. Example: <code>1</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date_debut</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_debut"                data-endpoint="GETapi-admin-historique-journal"
               value="2026-01-01"
               data-component="query">
    <br>
<p>Date de début. Example: <code>2026-01-01</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>date_fin</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_fin"                data-endpoint="GETapi-admin-historique-journal"
               value="2026-12-31"
               data-component="query">
    <br>
<p>Date de fin. Example: <code>2026-12-31</code></p>
            </div>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>per_page</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="per_page"                data-endpoint="GETapi-admin-historique-journal"
               value="30"
               data-component="query">
    <br>
<p>Résultats par page (défaut: 30). Example: <code>30</code></p>
            </div>
                </form>

                    <h2 id="admin-historique-audit-GETapi-admin-historique-actions">Actions disponibles dans le journal</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retourne la liste des types d'actions enregistrés.</p>

<span id="example-requests-GETapi-admin-historique-actions">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/historique/actions" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/historique/actions"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-historique-actions">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    &quot;paiement.enregistre&quot;,
    &quot;cycle.ouvert&quot;,
    &quot;cycle.ferme&quot;
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-historique-actions" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-historique-actions"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-historique-actions"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-historique-actions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-historique-actions">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-historique-actions" data-method="GET"
      data-path="api/admin/historique/actions"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-historique-actions', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-historique-actions"
                    onclick="tryItOut('GETapi-admin-historique-actions');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-historique-actions"
                    onclick="cancelTryOut('GETapi-admin-historique-actions');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-historique-actions"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/historique/actions</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-historique-actions"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-historique-actions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-historique-actions"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="admin-invitations">Admin — Invitations</h1>

    

                                <h2 id="admin-invitations-GETapi-admin-tontines--tontine_id--invitations">Liste des invitations d&#039;une tontine</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-admin-tontines--tontine_id--invitations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/tontines/16/invitations?statut=en_attente" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/invitations"
);

const params = {
    "statut": "en_attente",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-tontines--tontine_id--invitations">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;email&quot;: &quot;alice@example.com&quot;,
        &quot;statut&quot;: &quot;en_attente&quot;,
        &quot;expires_at&quot;: &quot;2026-04-16T10:00:00&quot;,
        &quot;invite_par&quot;: &quot;Admin Test&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-tontines--tontine_id--invitations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-tontines--tontine_id--invitations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-tontines--tontine_id--invitations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-tontines--tontine_id--invitations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-tontines--tontine_id--invitations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-tontines--tontine_id--invitations" data-method="GET"
      data-path="api/admin/tontines/{tontine_id}/invitations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-tontines--tontine_id--invitations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-tontines--tontine_id--invitations"
                    onclick="tryItOut('GETapi-admin-tontines--tontine_id--invitations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-tontines--tontine_id--invitations"
                    onclick="cancelTryOut('GETapi-admin-tontines--tontine_id--invitations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-tontines--tontine_id--invitations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/tontines/{tontine_id}/invitations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-tontines--tontine_id--invitations"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-tontines--tontine_id--invitations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-tontines--tontine_id--invitations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-tontines--tontine_id--invitations"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-admin-tontines--tontine_id--invitations"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>Query Parameters</b></h4>
                                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>statut</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="statut"                data-endpoint="GETapi-admin-tontines--tontine_id--invitations"
               value="en_attente"
               data-component="query">
    <br>
<p>Filtrer par statut (en_attente|acceptee|refusee|expiree). Example: <code>en_attente</code></p>
            </div>
                </form>

                    <h2 id="admin-invitations-POSTapi-admin-tontines--tontine_id--invitations">Envoyer une invitation</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Invite un utilisateur (existant ou nouveau) à rejoindre une tontine.
Un email avec un lien d'acceptation est envoyé automatiquement.</p>

<span id="example-requests-POSTapi-admin-tontines--tontine_id--invitations">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/tontines/16/invitations" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"alice@example.com\",
    \"message\": \"Rejoins notre groupe !\",
    \"expires_in_hours\": 72
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/invitations"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "alice@example.com",
    "message": "Rejoins notre groupe !",
    "expires_in_hours": 72
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-tontines--tontine_id--invitations">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invitation envoy&eacute;e &agrave; alice@example.com.&quot;,
    &quot;invitation&quot;: {
        &quot;id&quot;: 1,
        &quot;email&quot;: &quot;alice@example.com&quot;,
        &quot;token&quot;: &quot;abc123...&quot;,
        &quot;statut&quot;: &quot;en_attente&quot;,
        &quot;expires_at&quot;: &quot;2026-04-16T10:00:00&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-tontines--tontine_id--invitations" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-tontines--tontine_id--invitations"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-tontines--tontine_id--invitations"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-tontines--tontine_id--invitations" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-tontines--tontine_id--invitations">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-tontines--tontine_id--invitations" data-method="POST"
      data-path="api/admin/tontines/{tontine_id}/invitations"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-tontines--tontine_id--invitations', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-tontines--tontine_id--invitations"
                    onclick="tryItOut('POSTapi-admin-tontines--tontine_id--invitations');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-tontines--tontine_id--invitations"
                    onclick="cancelTryOut('POSTapi-admin-tontines--tontine_id--invitations');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-tontines--tontine_id--invitations"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/tontines/{tontine_id}/invitations</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-tontines--tontine_id--invitations"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-tontines--tontine_id--invitations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-tontines--tontine_id--invitations"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--invitations"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="POSTapi-admin-tontines--tontine_id--invitations"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-admin-tontines--tontine_id--invitations"
               value="alice@example.com"
               data-component="body">
    <br>
<p>Email de la personne à inviter. Example: <code>alice@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>message</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="message"                data-endpoint="POSTapi-admin-tontines--tontine_id--invitations"
               value="Rejoins notre groupe !"
               data-component="body">
    <br>
<p>Message personnalisé. Example: <code>Rejoins notre groupe !</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>expires_in_hours</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="expires_in_hours"                data-endpoint="POSTapi-admin-tontines--tontine_id--invitations"
               value="72"
               data-component="body">
    <br>
<p>Durée de validité en heures (défaut: 48). Example: <code>72</code></p>
        </div>
        </form>

                    <h2 id="admin-invitations-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-">Annuler une invitation</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/admin/tontines/16/invitations/16" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/invitations/16"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invitation annul&eacute;e.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-" data-method="DELETE"
      data-path="api/admin/tontines/{tontine_id}/invitations/{invitation_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
                    onclick="tryItOut('DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
                    onclick="cancelTryOut('DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/admin/tontines/{tontine_id}/invitations/{invitation_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>invitation_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="invitation_id"                data-endpoint="DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the invitation. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>invitation</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="invitation"                data-endpoint="DELETEapi-admin-tontines--tontine_id--invitations--invitation_id-"
               value="1"
               data-component="url">
    <br>
<p>ID de l'invitation. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="admin-membres">Admin — Membres</h1>

    

                                <h2 id="admin-membres-GETapi-admin-membres">Liste des membres</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retourne la liste paginée des membres avec leur statut de paiement
et le montant total cotisé estimé.</p>

<span id="example-requests-GETapi-admin-membres">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/membres" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/membres"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-membres">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;nom_complet&quot;: &quot;Jean Dupont&quot;,
            &quot;phone&quot;: &quot;+33600000000&quot;,
            &quot;email&quot;: &quot;jean@example.com&quot;,
            &quot;statut_paiement&quot;: &quot;pay&eacute;&quot;,
            &quot;type_tontine&quot;: &quot;Tontine Mensuelle&quot;,
            &quot;montant_total_cotise&quot;: &quot;150.00&quot;,
            &quot;ordre_passage&quot;: 1
        }
    ],
    &quot;current_page&quot;: 1,
    &quot;per_page&quot;: 15,
    &quot;total&quot;: 1
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-membres" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-membres"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-membres"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-membres" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-membres">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-membres" data-method="GET"
      data-path="api/admin/membres"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-membres', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-membres"
                    onclick="tryItOut('GETapi-admin-membres');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-membres"
                    onclick="cancelTryOut('GETapi-admin-membres');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-membres"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/membres</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-membres"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-membres"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-membres"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="admin-notifications">Admin — Notifications</h1>

    

                                <h2 id="admin-notifications-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel">Envoyer un rappel de paiement</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Dispatche un rappel à tous les membres n'ayant pas encore payé le cycle actif.</p>

<span id="example-requests-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/tontines/16/cycles/16/notifier/rappel" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/cycles/16/notifier/rappel"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Rappel de paiement envoy&eacute; en queue pour le cycle 2.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel" data-method="POST"
      data-path="api/admin/tontines/{tontine_id}/cycles/{cycle_id}/notifier/rappel"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
                    onclick="tryItOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
                    onclick="cancelTryOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/tontines/{tontine_id}/cycles/{cycle_id}/notifier/rappel</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
               value="16"
               data-component="url">
    <br>
<p>The ID of the cycle. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-rappel"
               value="1"
               data-component="url">
    <br>
<p>ID du cycle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-notifications-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard">Envoyer une alerte de retard</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Dispatche une alerte aux membres en retard de paiement.</p>

<span id="example-requests-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/tontines/16/cycles/16/notifier/retard" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/cycles/16/notifier/retard"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Alerte retard envoy&eacute;e en queue pour le cycle 2.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard" data-method="POST"
      data-path="api/admin/tontines/{tontine_id}/cycles/{cycle_id}/notifier/retard"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
                    onclick="tryItOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
                    onclick="cancelTryOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/tontines/{tontine_id}/cycles/{cycle_id}/notifier/retard</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
               value="16"
               data-component="url">
    <br>
<p>The ID of the cycle. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-retard"
               value="1"
               data-component="url">
    <br>
<p>ID du cycle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-notifications-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire">Notifier le bénéficiaire</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Envoie une notification au bénéficiaire du cycle actif.</p>

<span id="example-requests-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/tontines/16/cycles/16/notifier/beneficiaire" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/cycles/16/notifier/beneficiaire"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Notification envoy&eacute;e au b&eacute;n&eacute;ficiaire Alice Dupont.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire" data-method="POST"
      data-path="api/admin/tontines/{tontine_id}/cycles/{cycle_id}/notifier/beneficiaire"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
                    onclick="tryItOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
                    onclick="cancelTryOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/tontines/{tontine_id}/cycles/{cycle_id}/notifier/beneficiaire</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
               value="16"
               data-component="url">
    <br>
<p>The ID of the cycle. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--notifier-beneficiaire"
               value="1"
               data-component="url">
    <br>
<p>ID du cycle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-notifications-GETapi-notifications">Notifications reçues par le membre connecté</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retourne les notifications en base de données du membre authentifié.</p>

<span id="example-requests-GETapi-notifications">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/notifications" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/notifications"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-notifications">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;non_lues&quot;: 2,
    &quot;notifications&quot;: [
        {
            &quot;id&quot;: &quot;uuid&quot;,
            &quot;type&quot;: &quot;rappel_paiement&quot;,
            &quot;message&quot;: &quot;...&quot;,
            &quot;created_at&quot;: &quot;...&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-notifications" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-notifications"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-notifications"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-notifications" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-notifications">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-notifications" data-method="GET"
      data-path="api/notifications"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-notifications', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-notifications"
                    onclick="tryItOut('GETapi-notifications');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-notifications"
                    onclick="cancelTryOut('GETapi-notifications');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-notifications"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/notifications</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-notifications"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-notifications"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="admin-notifications-PATCHapi-notifications--id--lue">Marquer une notification comme lue</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHapi-notifications--id--lue">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/api/notifications/550e8400-e29b-41d4-a716-446655440000/lue" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/notifications/550e8400-e29b-41d4-a716-446655440000/lue"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-notifications--id--lue">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Notification marqu&eacute;e comme lue.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHapi-notifications--id--lue" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-notifications--id--lue"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-notifications--id--lue"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-notifications--id--lue" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-notifications--id--lue">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-notifications--id--lue" data-method="PATCH"
      data-path="api/notifications/{id}/lue"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-notifications--id--lue', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-notifications--id--lue"
                    onclick="tryItOut('PATCHapi-notifications--id--lue');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-notifications--id--lue"
                    onclick="cancelTryOut('PATCHapi-notifications--id--lue');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-notifications--id--lue"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/notifications/{id}/lue</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-notifications--id--lue"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-notifications--id--lue"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-notifications--id--lue"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PATCHapi-notifications--id--lue"
               value="550e8400-e29b-41d4-a716-446655440000"
               data-component="url">
    <br>
<p>UUID de la notification. Example: <code>550e8400-e29b-41d4-a716-446655440000</code></p>
            </div>
                    </form>

                    <h2 id="admin-notifications-PATCHapi-notifications-toutes-lues">Marquer toutes les notifications comme lues</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHapi-notifications-toutes-lues">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/api/notifications/toutes-lues" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/notifications/toutes-lues"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "PATCH",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHapi-notifications-toutes-lues">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Toutes les notifications ont &eacute;t&eacute; marqu&eacute;es comme lues.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHapi-notifications-toutes-lues" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHapi-notifications-toutes-lues"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHapi-notifications-toutes-lues"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHapi-notifications-toutes-lues" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHapi-notifications-toutes-lues">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHapi-notifications-toutes-lues" data-method="PATCH"
      data-path="api/notifications/toutes-lues"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHapi-notifications-toutes-lues', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHapi-notifications-toutes-lues"
                    onclick="tryItOut('PATCHapi-notifications-toutes-lues');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHapi-notifications-toutes-lues"
                    onclick="cancelTryOut('PATCHapi-notifications-toutes-lues');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHapi-notifications-toutes-lues"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>api/notifications/toutes-lues</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHapi-notifications-toutes-lues"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHapi-notifications-toutes-lues"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHapi-notifications-toutes-lues"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="admin-paiements">Admin — Paiements</h1>

    

                                <h2 id="admin-paiements-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">Liste des paiements d&#039;un cycle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retourne tous les paiements enregistrés pour un cycle,
ainsi que les membres n'ayant pas encore payé (en retard).</p>

<span id="example-requests-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/tontines/16/cycles/16/paiements" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/cycles/16/paiements"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;cycle&quot;: {
        &quot;id&quot;: 1,
        &quot;numero_cycle&quot;: 1,
        &quot;statut&quot;: &quot;ouvert&quot;
    },
    &quot;paiements&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;montant&quot;: &quot;5000.00&quot;,
            &quot;statut&quot;: &quot;paye&quot;,
            &quot;paid_at&quot;: &quot;2026-01-10&quot;,
            &quot;membre&quot;: {
                &quot;id&quot;: 3,
                &quot;first_name&quot;: &quot;Alice&quot;,
                &quot;last_name&quot;: &quot;Dupont&quot;
            }
        }
    ],
    &quot;en_retard&quot;: [
        {
            &quot;id&quot;: 5,
            &quot;first_name&quot;: &quot;Bob&quot;,
            &quot;last_name&quot;: &quot;Martin&quot;,
            &quot;ordre_passage&quot;: 2
        }
    ],
    &quot;resume&quot;: {
        &quot;total_membres&quot;: 4,
        &quot;ont_paye&quot;: 1,
        &quot;en_retard&quot;: 3
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements" data-method="GET"
      data-path="api/admin/tontines/{tontine_id}/cycles/{cycle_id}/paiements"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
                    onclick="tryItOut('GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
                    onclick="cancelTryOut('GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/tontines/{tontine_id}/cycles/{cycle_id}/paiements</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle_id"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="16"
               data-component="url">
    <br>
<p>The ID of the cycle. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="1"
               data-component="url">
    <br>
<p>ID du cycle. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-paiements-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">Enregistrer un paiement</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Enregistre le paiement d'un membre pour un cycle donné.
❗ Un membre ne peut payer qu'une seule fois par cycle (doublon bloqué).
Le statut est automatiquement calculé selon la date de paiement.</p>

<span id="example-requests-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/tontines/16/cycles/16/paiements" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"user_id\": 3,
    \"montant\": 5000,
    \"paid_at\": \"2026-01-10\",
    \"note\": \"Paiement en espèces\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/cycles/16/paiements"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "user_id": 3,
    "montant": 5000,
    "paid_at": "2026-01-10",
    "note": "Paiement en espèces"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;montant&quot;: &quot;5000.00&quot;,
    &quot;statut&quot;: &quot;paye&quot;,
    &quot;paid_at&quot;: &quot;2026-01-10&quot;,
    &quot;membre&quot;: {
        &quot;id&quot;: 3,
        &quot;first_name&quot;: &quot;Alice&quot;,
        &quot;last_name&quot;: &quot;Dupont&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Double paiement):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Ce membre a d&eacute;j&agrave; pay&eacute; pour ce cycle.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements" data-method="POST"
      data-path="api/admin/tontines/{tontine_id}/cycles/{cycle_id}/paiements"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
                    onclick="tryItOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
                    onclick="cancelTryOut('POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/tontines/{tontine_id}/cycles/{cycle_id}/paiements</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="16"
               data-component="url">
    <br>
<p>The ID of the cycle. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="1"
               data-component="url">
    <br>
<p>ID du cycle. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="3"
               data-component="body">
    <br>
<p>ID du membre. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>montant</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="montant"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="5000"
               data-component="body">
    <br>
<p>Montant payé. Example: <code>5000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>paid_at</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="paid_at"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="2026-01-10"
               data-component="body">
    <br>
<p>Date du paiement (YYYY-MM-DD, défaut: aujourd'hui). Example: <code>2026-01-10</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>note</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="note"                data-endpoint="POSTapi-admin-tontines--tontine_id--cycles--cycle_id--paiements"
               value="Paiement en espèces"
               data-component="body">
    <br>
<p>Note optionnelle. Example: <code>Paiement en espèces</code></p>
        </div>
        </form>

                    <h2 id="admin-paiements-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-">Statut de paiement d&#039;un membre pour un cycle</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Vérifie si un membre a payé ou est en retard pour un cycle donné.</p>

<span id="example-requests-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/tontines/16/cycles/16/paiements/membres/16" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontines/16/cycles/16/paiements/membres/16"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;membre&quot;: {
        &quot;id&quot;: 3,
        &quot;first_name&quot;: &quot;Alice&quot;,
        &quot;last_name&quot;: &quot;Dupont&quot;
    },
    &quot;statut&quot;: &quot;paye&quot;,
    &quot;paiement&quot;: {
        &quot;id&quot;: 1,
        &quot;montant&quot;: &quot;5000.00&quot;,
        &quot;paid_at&quot;: &quot;2026-01-10&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-" data-method="GET"
      data-path="api/admin/tontines/{tontine_id}/cycles/{cycle_id}/paiements/membres/{user_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
                    onclick="tryItOut('GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
                    onclick="cancelTryOut('GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/tontines/{tontine_id}/cycles/{cycle_id}/paiements/membres/{user_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle_id"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the cycle. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>cycle</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="cycle"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
               value="1"
               data-component="url">
    <br>
<p>ID du cycle. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user"                data-endpoint="GETapi-admin-tontines--tontine_id--cycles--cycle_id--paiements-membres--user_id-"
               value="3"
               data-component="url">
    <br>
<p>ID du membre. Example: <code>3</code></p>
            </div>
                    </form>

                <h1 id="admin-types-de-tontine-par-membre">Admin — Types de Tontine par Membre</h1>

    

                                <h2 id="admin-types-de-tontine-par-membre-GETapi-admin-membres--user_id--tontine-types">Types d&#039;un membre</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retourne tous les types de tontine auxquels un membre est inscrit.</p>

<span id="example-requests-GETapi-admin-membres--user_id--tontine-types">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/admin/membres/16/tontine-types" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/membres/16/tontine-types"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-admin-membres--user_id--tontine-types">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;nom&quot;: &quot;Bronze&quot;,
        &quot;montant&quot;: &quot;5000.00&quot;,
        &quot;devise&quot;: &quot;FCFA&quot;,
        &quot;pivot&quot;: {
            &quot;date_adhesion&quot;: &quot;2026-01-15&quot;,
            &quot;ajoute_par&quot;: 2
        }
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-admin-membres--user_id--tontine-types" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-admin-membres--user_id--tontine-types"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-admin-membres--user_id--tontine-types"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-admin-membres--user_id--tontine-types" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-admin-membres--user_id--tontine-types">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-admin-membres--user_id--tontine-types" data-method="GET"
      data-path="api/admin/membres/{user_id}/tontine-types"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-admin-membres--user_id--tontine-types', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-admin-membres--user_id--tontine-types"
                    onclick="tryItOut('GETapi-admin-membres--user_id--tontine-types');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-admin-membres--user_id--tontine-types"
                    onclick="cancelTryOut('GETapi-admin-membres--user_id--tontine-types');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-admin-membres--user_id--tontine-types"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/admin/membres/{user_id}/tontine-types</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-admin-membres--user_id--tontine-types"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-admin-membres--user_id--tontine-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-admin-membres--user_id--tontine-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="GETapi-admin-membres--user_id--tontine-types"
               value="16"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user"                data-endpoint="GETapi-admin-membres--user_id--tontine-types"
               value="1"
               data-component="url">
    <br>
<p>ID du membre. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="admin-types-de-tontine-par-membre-POSTapi-admin-membres--user_id--tontine-types">Assigner un type à un membre</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Inscrit un membre à un ou plusieurs types de tontine.</p>

<span id="example-requests-POSTapi-admin-membres--user_id--tontine-types">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/membres/16/tontine-types" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tontine_type_ids\": [
        1,
        2
    ],
    \"date_adhesion\": \"2026-01-15\",
    \"tontine_type_ids[]\": 1
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/membres/16/tontine-types"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tontine_type_ids": [
        1,
        2
    ],
    "date_adhesion": "2026-01-15",
    "tontine_type_ids[]": 1
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-membres--user_id--tontine-types">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Types assign&eacute;s avec succ&egrave;s.&quot;,
    &quot;types&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;nom&quot;: &quot;Bronze&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;nom&quot;: &quot;Silver&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-membres--user_id--tontine-types" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-membres--user_id--tontine-types"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-membres--user_id--tontine-types"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-membres--user_id--tontine-types" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-membres--user_id--tontine-types">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-membres--user_id--tontine-types" data-method="POST"
      data-path="api/admin/membres/{user_id}/tontine-types"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-membres--user_id--tontine-types', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-membres--user_id--tontine-types"
                    onclick="tryItOut('POSTapi-admin-membres--user_id--tontine-types');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-membres--user_id--tontine-types"
                    onclick="cancelTryOut('POSTapi-admin-membres--user_id--tontine-types');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-membres--user_id--tontine-types"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/membres/{user_id}/tontine-types</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-membres--user_id--tontine-types"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-membres--user_id--tontine-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-membres--user_id--tontine-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="POSTapi-admin-membres--user_id--tontine-types"
               value="16"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user"                data-endpoint="POSTapi-admin-membres--user_id--tontine-types"
               value="1"
               data-component="url">
    <br>
<p>ID du membre. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tontine_type_ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tontine_type_ids[0]"                data-endpoint="POSTapi-admin-membres--user_id--tontine-types"
               data-component="body">
        <input type="text" style="display: none"
               name="tontine_type_ids[1]"                data-endpoint="POSTapi-admin-membres--user_id--tontine-types"
               data-component="body">
    <br>
<p>Liste des IDs de types à assigner.</p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_adhesion</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_adhesion"                data-endpoint="POSTapi-admin-membres--user_id--tontine-types"
               value="2026-01-15"
               data-component="body">
    <br>
<p>Date d'adhésion (YYYY-MM-DD). Example: <code>2026-01-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tontine_type_ids[]</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_type_ids.0"                data-endpoint="POSTapi-admin-membres--user_id--tontine-types"
               value="1"
               data-component="body">
    <br>
<p>ID d'un type de tontine. Example: <code>1</code></p>
        </div>
        </form>

                    <h2 id="admin-types-de-tontine-par-membre-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-">Retirer un type d&#039;un membre</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Supprime l'inscription d'un membre à un type de tontine spécifique.</p>

<span id="example-requests-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/admin/membres/16/tontine-types/16" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/membres/16/tontine-types/16"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Type retir&eacute; avec succ&egrave;s.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-" data-method="DELETE"
      data-path="api/admin/membres/{user_id}/tontine-types/{tontineType_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
                    onclick="tryItOut('DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
                    onclick="cancelTryOut('DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/admin/membres/{user_id}/tontine-types/{tontineType_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user_id"                data-endpoint="DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the user. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontineType_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontineType_id"                data-endpoint="DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontineType. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>user</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="user"                data-endpoint="DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
               value="1"
               data-component="url">
    <br>
<p>ID du membre. Example: <code>1</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontineType</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontineType"                data-endpoint="DELETEapi-admin-membres--user_id--tontine-types--tontineType_id-"
               value="1"
               data-component="url">
    <br>
<p>ID du type à retirer. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="authentification">Authentification</h1>

    <p>Inscription, connexion et gestion de session.</p>

                                <h2 id="authentification-GETapi-auth-register-form">Données du formulaire d&#039;inscription</h2>

<p>
</p>

<p>Retourne les types de tontine et les tontines disponibles
pour alimenter les selects du formulaire d'inscription.</p>

<span id="example-requests-GETapi-auth-register-form">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/auth/register-form" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/auth/register-form"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-auth-register-form">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;tontine_types&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;nom&quot;: &quot;Bronze&quot;,
            &quot;montant&quot;: &quot;5000.00&quot;,
            &quot;devise&quot;: &quot;FCFA&quot;,
            &quot;description&quot;: &quot;Formule de base&quot;
        },
        {
            &quot;id&quot;: 2,
            &quot;nom&quot;: &quot;Silver&quot;,
            &quot;montant&quot;: &quot;10000.00&quot;,
            &quot;devise&quot;: &quot;FCFA&quot;,
            &quot;description&quot;: &quot;Formule interm&eacute;diaire&quot;
        },
        {
            &quot;id&quot;: 3,
            &quot;nom&quot;: &quot;Gold&quot;,
            &quot;montant&quot;: &quot;25000.00&quot;,
            &quot;devise&quot;: &quot;FCFA&quot;,
            &quot;description&quot;: &quot;Formule premium&quot;
        }
    ],
    &quot;tontines&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;nom&quot;: &quot;Tontine Solidarit&eacute;&quot;,
            &quot;frequence&quot;: &quot;mensuel&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-auth-register-form" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-auth-register-form"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-auth-register-form"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-auth-register-form" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-auth-register-form">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-auth-register-form" data-method="GET"
      data-path="api/auth/register-form"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-register-form', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-auth-register-form"
                    onclick="tryItOut('GETapi-auth-register-form');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-auth-register-form"
                    onclick="cancelTryOut('GETapi-auth-register-form');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-auth-register-form"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/auth/register-form</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-auth-register-form"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-auth-register-form"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentification-POSTapi-auth-register">Inscription</h2>

<p>
</p>

<p>Crée un nouveau compte membre et retourne un token Sanctum.</p>

<span id="example-requests-POSTapi-auth-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/auth/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"first_name\": \"Alice\",
    \"last_name\": \"Dupont\",
    \"email\": \"alice@example.com\",
    \"phone\": \"+22890000000\",
    \"password\": \"password123\",
    \"role\": \"membre\",
    \"tontine_id\": 1,
    \"date_adhesion\": \"2026-01-15\",
    \"ordre_passage\": 3,
    \"adresse\": \"12 Rue des Fleurs\",
    \"quartier\": \"Bè Kpota\",
    \"profession\": \"Commerçante\",
    \"piece_identite_type\": \"CNI\",
    \"piece_identite_numero\": \"TG-123456\",
    \"password_confirmation\": \"password123\",
    \"tontine_type_id\": 2
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/auth/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first_name": "Alice",
    "last_name": "Dupont",
    "email": "alice@example.com",
    "phone": "+22890000000",
    "password": "password123",
    "role": "membre",
    "tontine_id": 1,
    "date_adhesion": "2026-01-15",
    "ordre_passage": 3,
    "adresse": "12 Rue des Fleurs",
    "quartier": "Bè Kpota",
    "profession": "Commerçante",
    "piece_identite_type": "CNI",
    "piece_identite_numero": "TG-123456",
    "password_confirmation": "password123",
    "tontine_type_id": 2
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-register">
            <blockquote>
            <p>Example response (201, Succès):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;Alice&quot;,
        &quot;last_name&quot;: &quot;Dupont&quot;,
        &quot;email&quot;: &quot;alice@example.com&quot;,
        &quot;phone&quot;: &quot;+22890000000&quot;,
        &quot;role&quot;: &quot;membre&quot;,
        &quot;tontine_id&quot;: 1,
        &quot;tontine_type_id&quot;: 2,
        &quot;date_adhesion&quot;: &quot;2026-01-15&quot;,
        &quot;ordre_passage&quot;: 3,
        &quot;tontine_type&quot;: {
            &quot;id&quot;: 2,
            &quot;nom&quot;: &quot;Silver&quot;,
            &quot;montant&quot;: &quot;10000.00&quot;,
            &quot;devise&quot;: &quot;FCFA&quot;
        }
    },
    &quot;token&quot;: &quot;1|xxxxxxxxxxxxxxxxxxxxxxxx&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-register" data-method="POST"
      data-path="api/auth/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-register"
                    onclick="tryItOut('POSTapi-auth-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-register"
                    onclick="cancelTryOut('POSTapi-auth-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>first_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="first_name"                data-endpoint="POSTapi-auth-register"
               value="Alice"
               data-component="body">
    <br>
<p>Prénom. Example: <code>Alice</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>last_name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="last_name"                data-endpoint="POSTapi-auth-register"
               value="Dupont"
               data-component="body">
    <br>
<p>Nom de famille. Example: <code>Dupont</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-register"
               value="alice@example.com"
               data-component="body">
    <br>
<p>Adresse email unique. Example: <code>alice@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>phone</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="phone"                data-endpoint="POSTapi-auth-register"
               value="+22890000000"
               data-component="body">
    <br>
<p>Numéro de téléphone unique. Example: <code>+22890000000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-register"
               value="password123"
               data-component="body">
    <br>
<p>Mot de passe (min 8 caractères). Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>role</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="role"                data-endpoint="POSTapi-auth-register"
               value="membre"
               data-component="body">
    <br>
<p>Rôle : admin ou membre (défaut: membre). Example: <code>membre</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="POSTapi-auth-register"
               value="1"
               data-component="body">
    <br>
<p>ID de la tontine concernée. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>date_adhesion</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="date_adhesion"                data-endpoint="POSTapi-auth-register"
               value="2026-01-15"
               data-component="body">
    <br>
<p>Date d'adhésion (YYYY-MM-DD). Example: <code>2026-01-15</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ordre_passage</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="ordre_passage"                data-endpoint="POSTapi-auth-register"
               value="3"
               data-component="body">
    <br>
<p>Position dans la file de bénéficiaires. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>adresse</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="adresse"                data-endpoint="POSTapi-auth-register"
               value="12 Rue des Fleurs"
               data-component="body">
    <br>
<p>Adresse complète. Example: <code>12 Rue des Fleurs</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quartier</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="quartier"                data-endpoint="POSTapi-auth-register"
               value="Bè Kpota"
               data-component="body">
    <br>
<p>Quartier de résidence. Example: <code>Bè Kpota</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>profession</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="profession"                data-endpoint="POSTapi-auth-register"
               value="Commerçante"
               data-component="body">
    <br>
<p>Profession. Example: <code>Commerçante</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>piece_identite_type</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="piece_identite_type"                data-endpoint="POSTapi-auth-register"
               value="CNI"
               data-component="body">
    <br>
<p>Type de pièce d'identité (CNI, Passeport, etc.). Example: <code>CNI</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>piece_identite_numero</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="piece_identite_numero"                data-endpoint="POSTapi-auth-register"
               value="TG-123456"
               data-component="body">
    <br>
<p>Numéro de la pièce d'identité. Example: <code>TG-123456</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password_confirmation</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password_confirmation"                data-endpoint="POSTapi-auth-register"
               value="password123"
               data-component="body">
    <br>
<p>Confirmation du mot de passe. Example: <code>password123</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tontine_type_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_type_id"                data-endpoint="POSTapi-auth-register"
               value="2"
               data-component="body">
    <br>
<p>ID du type de tontine choisi (Bronze, Silver, Gold…). Example: <code>2</code></p>
        </div>
        </form>

                    <h2 id="authentification-POSTapi-auth-login">Connexion</h2>

<p>
</p>

<p>Authentifie l'utilisateur via email/mot de passe et retourne un token Sanctum.</p>

<span id="example-requests-POSTapi-auth-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/auth/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"email\": \"alice@example.com\",
    \"password\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/auth/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "alice@example.com",
    "password": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-login">
            <blockquote>
            <p>Example response (200, Succès):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;user&quot;: {
        &quot;id&quot;: 1,
        &quot;first_name&quot;: &quot;Alice&quot;,
        &quot;last_name&quot;: &quot;Dupont&quot;,
        &quot;role&quot;: &quot;membre&quot;
    },
    &quot;token&quot;: &quot;1|xxxxxxxxxxxxxxxxxxxxxxxx&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422, Identifiants incorrects):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Les identifiants sont incorrects.&quot;,
    &quot;errors&quot;: {
        &quot;email&quot;: [
            &quot;Les identifiants sont incorrects.&quot;
        ]
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-login" data-method="POST"
      data-path="api/auth/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-login"
                    onclick="tryItOut('POSTapi-auth-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-login"
                    onclick="cancelTryOut('POSTapi-auth-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-auth-login"
               value="alice@example.com"
               data-component="body">
    <br>
<p>Adresse email. Example: <code>alice@example.com</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-auth-login"
               value="password123"
               data-component="body">
    <br>
<p>Mot de passe. Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="authentification-POSTapi-auth-logout">Déconnexion</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Révoque le token actuel.</p>

<span id="example-requests-POSTapi-auth-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/auth/logout" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/auth/logout"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-auth-logout">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;D&eacute;connect&eacute; avec succ&egrave;s.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-auth-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-auth-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-auth-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-auth-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-auth-logout" data-method="POST"
      data-path="api/auth/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-auth-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-auth-logout"
                    onclick="tryItOut('POSTapi-auth-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-auth-logout"
                    onclick="cancelTryOut('POSTapi-auth-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-auth-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/auth/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-auth-logout"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-auth-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentification-GETapi-auth-me">Profil connecté</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retourne le profil complet de l'utilisateur authentifié.</p>

<span id="example-requests-GETapi-auth-me">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/auth/me" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/auth/me"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-auth-me">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;first_name&quot;: &quot;Alice&quot;,
    &quot;last_name&quot;: &quot;Dupont&quot;,
    &quot;email&quot;: &quot;alice@example.com&quot;,
    &quot;phone&quot;: &quot;+22890000000&quot;,
    &quot;role&quot;: &quot;membre&quot;,
    &quot;tontine&quot;: {
        &quot;id&quot;: 1,
        &quot;nom&quot;: &quot;Tontine Solidarit&eacute;&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-auth-me" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-auth-me"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-auth-me"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-auth-me" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-auth-me">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-auth-me" data-method="GET"
      data-path="api/auth/me"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-auth-me', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-auth-me"
                    onclick="tryItOut('GETapi-auth-me');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-auth-me"
                    onclick="cancelTryOut('GETapi-auth-me');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-auth-me"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/auth/me</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-auth-me"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-auth-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-auth-me"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="invitations-reponse">Invitations — Réponse</h1>

    <p>Accepter ou refuser une invitation à une tontine via le token reçu par email.</p>

                                <h2 id="invitations-reponse-GETapi-invitations--token-">Consulter une invitation</h2>

<p>
</p>

<p>Retourne les détails d'une invitation à partir de son token.</p>

<span id="example-requests-GETapi-invitations--token-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/invitations/abc123xyz" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/invitations/abc123xyz"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-invitations--token-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;tontine&quot;: {
        &quot;nom&quot;: &quot;Tontine Solidarit&eacute;&quot;,
        &quot;montant_cotisation&quot;: &quot;5000.00&quot;
    },
    &quot;invite_par&quot;: &quot;Admin Test&quot;,
    &quot;email&quot;: &quot;alice@example.com&quot;,
    &quot;statut&quot;: &quot;en_attente&quot;,
    &quot;expires_at&quot;: &quot;2026-04-16T10:00:00&quot;,
    &quot;message&quot;: &quot;Rejoins notre groupe !&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-invitations--token-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-invitations--token-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-invitations--token-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-invitations--token-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-invitations--token-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-invitations--token-" data-method="GET"
      data-path="api/invitations/{token}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-invitations--token-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-invitations--token-"
                    onclick="tryItOut('GETapi-invitations--token-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-invitations--token-"
                    onclick="cancelTryOut('GETapi-invitations--token-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-invitations--token-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/invitations/{token}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-invitations--token-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-invitations--token-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="GETapi-invitations--token-"
               value="abc123xyz"
               data-component="url">
    <br>
<p>Token de l'invitation. Example: <code>abc123xyz</code></p>
            </div>
                    </form>

                    <h2 id="invitations-reponse-POSTapi-invitations--token--accepter">Accepter une invitation</h2>

<p>
</p>

<p>Accepte l'invitation. Si l'utilisateur n'existe pas encore,
il doit s'inscrire d'abord puis rappeler cet endpoint avec son token auth.</p>

<span id="example-requests-POSTapi-invitations--token--accepter">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/invitations/abc123xyz/accepter" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/invitations/abc123xyz/accepter"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-invitations--token--accepter">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invitation accept&eacute;e. Vous &ecirc;tes maintenant membre de Tontine Solidarit&eacute;.&quot;,
    &quot;tontine&quot;: {
        &quot;id&quot;: 1,
        &quot;nom&quot;: &quot;Tontine Solidarit&eacute;&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-invitations--token--accepter" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-invitations--token--accepter"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-invitations--token--accepter"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-invitations--token--accepter" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-invitations--token--accepter">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-invitations--token--accepter" data-method="POST"
      data-path="api/invitations/{token}/accepter"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-invitations--token--accepter', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-invitations--token--accepter"
                    onclick="tryItOut('POSTapi-invitations--token--accepter');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-invitations--token--accepter"
                    onclick="cancelTryOut('POSTapi-invitations--token--accepter');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-invitations--token--accepter"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/invitations/{token}/accepter</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-invitations--token--accepter"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-invitations--token--accepter"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-invitations--token--accepter"
               value="abc123xyz"
               data-component="url">
    <br>
<p>Token de l'invitation. Example: <code>abc123xyz</code></p>
            </div>
                    </form>

                    <h2 id="invitations-reponse-POSTapi-invitations--token--refuser">Refuser une invitation</h2>

<p>
</p>



<span id="example-requests-POSTapi-invitations--token--refuser">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/invitations/abc123xyz/refuser" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/invitations/abc123xyz/refuser"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-invitations--token--refuser">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Invitation refus&eacute;e.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-invitations--token--refuser" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-invitations--token--refuser"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-invitations--token--refuser"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-invitations--token--refuser" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-invitations--token--refuser">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-invitations--token--refuser" data-method="POST"
      data-path="api/invitations/{token}/refuser"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-invitations--token--refuser', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-invitations--token--refuser"
                    onclick="tryItOut('POSTapi-invitations--token--refuser');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-invitations--token--refuser"
                    onclick="cancelTryOut('POSTapi-invitations--token--refuser');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-invitations--token--refuser"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/invitations/{token}/refuser</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-invitations--token--refuser"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-invitations--token--refuser"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>token</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="token"                data-endpoint="POSTapi-invitations--token--refuser"
               value="abc123xyz"
               data-component="url">
    <br>
<p>Token de l'invitation. Example: <code>abc123xyz</code></p>
            </div>
                    </form>

                <h1 id="membre-tableau-de-bord">Membre — Tableau de bord</h1>

    

                                <h2 id="membre-tableau-de-bord-GETapi-dashboard">Tableau de bord global du membre</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Retourne un résumé complet pour toutes les tontines du membre :
contributions versées, solde restant, prochain versement, position dans l'ordre.</p>

<span id="example-requests-GETapi-dashboard">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/dashboard" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-dashboard">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;membre&quot;: {
        &quot;id&quot;: 3,
        &quot;nom_complet&quot;: &quot;Alice Dupont&quot;,
        &quot;phone&quot;: &quot;+22890000000&quot;
    },
    &quot;tontines&quot;: [
        {
            &quot;tontine&quot;: {
                &quot;id&quot;: 1,
                &quot;nom&quot;: &quot;Tontine Solidarit&eacute;&quot;,
                &quot;montant_cotisation&quot;: &quot;5000.00&quot;,
                &quot;frequence&quot;: &quot;mensuel&quot;
            },
            &quot;position&quot;: 2,
            &quot;total_cycles&quot;: 6,
            &quot;contributions_versees&quot;: {
                &quot;nombre&quot;: 4,
                &quot;montant_total&quot;: &quot;20000.00&quot;
            },
            &quot;en_retard&quot;: {
                &quot;nombre&quot;: 1,
                &quot;montant&quot;: &quot;5000.00&quot;
            },
            &quot;solde_restant&quot;: &quot;10000.00&quot;,
            &quot;est_beneficiaire_cycle_actif&quot;: false,
            &quot;cycle_actif&quot;: {
                &quot;id&quot;: 2,
                &quot;numero_cycle&quot;: 2,
                &quot;statut&quot;: &quot;ouvert&quot;,
                &quot;date_ouverture&quot;: &quot;2026-02-01&quot;
            },
            &quot;prochain_versement&quot;: {
                &quot;cycle_numero&quot;: 2,
                &quot;montant&quot;: &quot;5000.00&quot;,
                &quot;statut&quot;: &quot;en_attente&quot;
            },
            &quot;historique_paiements&quot;: []
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dashboard" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dashboard"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dashboard"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dashboard" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dashboard">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dashboard" data-method="GET"
      data-path="api/dashboard"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dashboard', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-dashboard"
                    onclick="tryItOut('GETapi-dashboard');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-dashboard"
                    onclick="cancelTryOut('GETapi-dashboard');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-dashboard"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dashboard</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-dashboard"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dashboard"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="membre-tableau-de-bord-GETapi-dashboard-tontines--tontine_id-">Tableau de bord pour une tontine spécifique</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-dashboard-tontines--tontine_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/dashboard/tontines/16" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/tontines/16"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-dashboard-tontines--tontine_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;tontine&quot;: {
        &quot;id&quot;: 1,
        &quot;nom&quot;: &quot;Tontine Solidarit&eacute;&quot;
    },
    &quot;position&quot;: 2,
    &quot;contributions_versees&quot;: {
        &quot;nombre&quot;: 4,
        &quot;montant_total&quot;: &quot;20000.00&quot;
    },
    &quot;solde_restant&quot;: &quot;10000.00&quot;,
    &quot;prochain_versement&quot;: {
        &quot;cycle_numero&quot;: 2,
        &quot;montant&quot;: &quot;5000.00&quot;,
        &quot;statut&quot;: &quot;en_attente&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dashboard-tontines--tontine_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dashboard-tontines--tontine_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dashboard-tontines--tontine_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dashboard-tontines--tontine_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dashboard-tontines--tontine_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dashboard-tontines--tontine_id-" data-method="GET"
      data-path="api/dashboard/tontines/{tontine_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dashboard-tontines--tontine_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-dashboard-tontines--tontine_id-"
                    onclick="tryItOut('GETapi-dashboard-tontines--tontine_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-dashboard-tontines--tontine_id-"
                    onclick="cancelTryOut('GETapi-dashboard-tontines--tontine_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-dashboard-tontines--tontine_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dashboard/tontines/{tontine_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-dashboard-tontines--tontine_id-"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dashboard-tontines--tontine_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dashboard-tontines--tontine_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-dashboard-tontines--tontine_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-dashboard-tontines--tontine_id-"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="membre-tableau-de-bord-GETapi-dashboard-tontines--tontine_id--historique">Historique complet des paiements du membre pour une tontine</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-dashboard-tontines--tontine_id--historique">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/dashboard/tontines/16/historique" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/dashboard/tontines/16/historique"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-dashboard-tontines--tontine_id--historique">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;cycle_numero&quot;: 1,
        &quot;montant&quot;: &quot;5000.00&quot;,
        &quot;statut&quot;: &quot;paye&quot;,
        &quot;paid_at&quot;: &quot;2026-01-10&quot;
    },
    {
        &quot;cycle_numero&quot;: 2,
        &quot;montant&quot;: &quot;5000.00&quot;,
        &quot;statut&quot;: &quot;en_retard&quot;,
        &quot;paid_at&quot;: &quot;2026-02-15&quot;
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-dashboard-tontines--tontine_id--historique" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-dashboard-tontines--tontine_id--historique"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-dashboard-tontines--tontine_id--historique"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-dashboard-tontines--tontine_id--historique" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-dashboard-tontines--tontine_id--historique">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-dashboard-tontines--tontine_id--historique" data-method="GET"
      data-path="api/dashboard/tontines/{tontine_id}/historique"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-dashboard-tontines--tontine_id--historique', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-dashboard-tontines--tontine_id--historique"
                    onclick="tryItOut('GETapi-dashboard-tontines--tontine_id--historique');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-dashboard-tontines--tontine_id--historique"
                    onclick="cancelTryOut('GETapi-dashboard-tontines--tontine_id--historique');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-dashboard-tontines--tontine_id--historique"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/dashboard/tontines/{tontine_id}/historique</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETapi-dashboard-tontines--tontine_id--historique"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-dashboard-tontines--tontine_id--historique"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-dashboard-tontines--tontine_id--historique"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine_id"                data-endpoint="GETapi-dashboard-tontines--tontine_id--historique"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontine. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontine</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontine"                data-endpoint="GETapi-dashboard-tontines--tontine_id--historique"
               value="1"
               data-component="url">
    <br>
<p>ID de la tontine. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="types-de-tontine">Types de Tontine</h1>

    <p>Gestion des types/formules de tontine avec leurs montants.</p>

                                <h2 id="types-de-tontine-GETapi-tontine-types">Liste des types</h2>

<p>
</p>

<p>Retourne tous les types de tontine actifs.</p>

<span id="example-requests-GETapi-tontine-types">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/tontine-types" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/tontine-types"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tontine-types">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">[
    {
        &quot;id&quot;: 1,
        &quot;nom&quot;: &quot;Bronze&quot;,
        &quot;montant&quot;: &quot;5000.00&quot;,
        &quot;devise&quot;: &quot;FCFA&quot;,
        &quot;description&quot;: &quot;Formule de base&quot;,
        &quot;actif&quot;: true
    }
]</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tontine-types" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tontine-types"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tontine-types"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tontine-types" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tontine-types">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tontine-types" data-method="GET"
      data-path="api/tontine-types"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tontine-types', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tontine-types"
                    onclick="tryItOut('GETapi-tontine-types');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tontine-types"
                    onclick="cancelTryOut('GETapi-tontine-types');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tontine-types"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tontine-types</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tontine-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tontine-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="types-de-tontine-GETapi-tontine-types--tontineType_id-">Détail d&#039;un type</h2>

<p>
</p>



<span id="example-requests-GETapi-tontine-types--tontineType_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/tontine-types/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/tontine-types/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-tontine-types--tontineType_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 1,
    &quot;nom&quot;: &quot;Bronze&quot;,
    &quot;montant&quot;: &quot;5000.00&quot;,
    &quot;devise&quot;: &quot;FCFA&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-tontine-types--tontineType_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-tontine-types--tontineType_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-tontine-types--tontineType_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-tontine-types--tontineType_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-tontine-types--tontineType_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-tontine-types--tontineType_id-" data-method="GET"
      data-path="api/tontine-types/{tontineType_id}"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-tontine-types--tontineType_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-tontine-types--tontineType_id-"
                    onclick="tryItOut('GETapi-tontine-types--tontineType_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-tontine-types--tontineType_id-"
                    onclick="cancelTryOut('GETapi-tontine-types--tontineType_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-tontine-types--tontineType_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/tontine-types/{tontineType_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-tontine-types--tontineType_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-tontine-types--tontineType_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontineType_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontineType_id"                data-endpoint="GETapi-tontine-types--tontineType_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontineType. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="GETapi-tontine-types--tontineType_id-"
               value="1"
               data-component="url">
    <br>
<p>ID du type. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="types-de-tontine-POSTapi-admin-tontine-types">Créer un type</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Réservé aux admins.</p>

<span id="example-requests-POSTapi-admin-tontine-types">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/admin/tontine-types" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"nom\": \"Gold\",
    \"montant\": 25000,
    \"devise\": \"FCFA\",
    \"description\": \"Formule premium\",
    \"actif\": true
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontine-types"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "nom": "Gold",
    "montant": 25000,
    "devise": "FCFA",
    "description": "Formule premium",
    "actif": true
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-admin-tontine-types">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;id&quot;: 3,
    &quot;nom&quot;: &quot;Gold&quot;,
    &quot;montant&quot;: &quot;25000.00&quot;,
    &quot;devise&quot;: &quot;FCFA&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-admin-tontine-types" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-admin-tontine-types"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-admin-tontine-types"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-admin-tontine-types" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-admin-tontine-types">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-admin-tontine-types" data-method="POST"
      data-path="api/admin/tontine-types"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-admin-tontine-types', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-admin-tontine-types"
                    onclick="tryItOut('POSTapi-admin-tontine-types');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-admin-tontine-types"
                    onclick="cancelTryOut('POSTapi-admin-tontine-types');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-admin-tontine-types"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/admin/tontine-types</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTapi-admin-tontine-types"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-admin-tontine-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-admin-tontine-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nom</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nom"                data-endpoint="POSTapi-admin-tontine-types"
               value="Gold"
               data-component="body">
    <br>
<p>Nom du type. Example: <code>Gold</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>montant</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="montant"                data-endpoint="POSTapi-admin-tontine-types"
               value="25000"
               data-component="body">
    <br>
<p>Montant de cotisation. Example: <code>25000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>devise</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="devise"                data-endpoint="POSTapi-admin-tontine-types"
               value="FCFA"
               data-component="body">
    <br>
<p>Devise (défaut: FCFA). Example: <code>FCFA</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="POSTapi-admin-tontine-types"
               value="Formule premium"
               data-component="body">
    <br>
<p>Description / avantages. Example: <code>Formule premium</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>actif</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="POSTapi-admin-tontine-types" style="display: none">
            <input type="radio" name="actif"
                   value="true"
                   data-endpoint="POSTapi-admin-tontine-types"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTapi-admin-tontine-types" style="display: none">
            <input type="radio" name="actif"
                   value="false"
                   data-endpoint="POSTapi-admin-tontine-types"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Actif ou non (défaut: true). Example: <code>true</code></p>
        </div>
        </form>

                    <h2 id="types-de-tontine-PUTapi-admin-tontine-types--tontineType_id-">Modifier un type</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Réservé aux admins.</p>

<span id="example-requests-PUTapi-admin-tontine-types--tontineType_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/admin/tontine-types/16" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"nom\": \"Silver Plus\",
    \"montant\": 15000,
    \"devise\": \"ngzmiy\",
    \"description\": \"Eius et animi quos velit et.\",
    \"actif\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontine-types/16"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "nom": "Silver Plus",
    "montant": 15000,
    "devise": "ngzmiy",
    "description": "Eius et animi quos velit et.",
    "actif": false
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-admin-tontine-types--tontineType_id-">
</span>
<span id="execution-results-PUTapi-admin-tontine-types--tontineType_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-admin-tontine-types--tontineType_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-admin-tontine-types--tontineType_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-admin-tontine-types--tontineType_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-admin-tontine-types--tontineType_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-admin-tontine-types--tontineType_id-" data-method="PUT"
      data-path="api/admin/tontine-types/{tontineType_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-admin-tontine-types--tontineType_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-admin-tontine-types--tontineType_id-"
                    onclick="tryItOut('PUTapi-admin-tontine-types--tontineType_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-admin-tontine-types--tontineType_id-"
                    onclick="cancelTryOut('PUTapi-admin-tontine-types--tontineType_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-admin-tontine-types--tontineType_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/admin/tontine-types/{tontineType_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontineType_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontineType_id"                data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontineType. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
               value="1"
               data-component="url">
    <br>
<p>ID du type. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nom</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nom"                data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
               value="Silver Plus"
               data-component="body">
    <br>
<p>Nom du type. Example: <code>Silver Plus</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>montant</code></b>&nbsp;&nbsp;
<small>number</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="montant"                data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
               value="15000"
               data-component="body">
    <br>
<p>Montant. Example: <code>15000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>devise</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="devise"                data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
               value="ngzmiy"
               data-component="body">
    <br>
<p>Must not be greater than 10 characters. Example: <code>ngzmiy</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>description</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="description"                data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
               value="Eius et animi quos velit et."
               data-component="body">
    <br>
<p>Example: <code>Eius et animi quos velit et.</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>actif</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <label data-endpoint="PUTapi-admin-tontine-types--tontineType_id-" style="display: none">
            <input type="radio" name="actif"
                   value="true"
                   data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="PUTapi-admin-tontine-types--tontineType_id-" style="display: none">
            <input type="radio" name="actif"
                   value="false"
                   data-endpoint="PUTapi-admin-tontine-types--tontineType_id-"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Activer/désactiver. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="types-de-tontine-DELETEapi-admin-tontine-types--tontineType_id-">Supprimer un type</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Réservé aux admins.</p>

<span id="example-requests-DELETEapi-admin-tontine-types--tontineType_id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/admin/tontine-types/16" \
    --header "Authorization: Bearer {VOTRE_TOKEN_SANCTUM}" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/admin/tontine-types/16"
);

const headers = {
    "Authorization": "Bearer {VOTRE_TOKEN_SANCTUM}",
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-admin-tontine-types--tontineType_id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Type supprim&eacute; avec succ&egrave;s.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-admin-tontine-types--tontineType_id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-admin-tontine-types--tontineType_id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-admin-tontine-types--tontineType_id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-admin-tontine-types--tontineType_id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-admin-tontine-types--tontineType_id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-admin-tontine-types--tontineType_id-" data-method="DELETE"
      data-path="api/admin/tontine-types/{tontineType_id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-admin-tontine-types--tontineType_id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-admin-tontine-types--tontineType_id-"
                    onclick="tryItOut('DELETEapi-admin-tontine-types--tontineType_id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-admin-tontine-types--tontineType_id-"
                    onclick="cancelTryOut('DELETEapi-admin-tontine-types--tontineType_id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-admin-tontine-types--tontineType_id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/admin/tontine-types/{tontineType_id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEapi-admin-tontine-types--tontineType_id-"
               value="Bearer {VOTRE_TOKEN_SANCTUM}"
               data-component="header">
    <br>
<p>Example: <code>Bearer {VOTRE_TOKEN_SANCTUM}</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-admin-tontine-types--tontineType_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-admin-tontine-types--tontineType_id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>tontineType_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="tontineType_id"                data-endpoint="DELETEapi-admin-tontine-types--tontineType_id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the tontineType. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-admin-tontine-types--tontineType_id-"
               value="1"
               data-component="url">
    <br>
<p>ID du type. Example: <code>1</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
