# SISAG Pulse
**Le rythme de l’action publique, en temps réel.**

## 1. Introduction
Dans le cadre de la modernisation de l’administration publique congolaise, le gouvernement a lancé le **Système d’Information pour le Suivi de l’Action Gouvernementale (SISAG)**.  
Ce dispositif vise à centraliser les données des projets publics, suivre leur exécution, et renforcer la transparence.

**SISAG Pulse** est une interface web interactive conçue pour accompagner cette ambition.  
Elle permet de visualiser, comprendre, évaluer et enrichir les projets gouvernementaux, tout en facilitant le pilotage administratif et l’accès citoyen à l’information.

---

## 2. Problématique
Malgré les efforts de digitalisation, plusieurs défis persistent :
- Données dispersées entre ministères  
- Suivi peu lisible et difficilement accessible  
- Retards ou blocages non anticipés  
- Faible implication citoyenne  
- Absence d’outils pédagogiques pour vulgariser l’action publique

---

## 3. Solution proposée
SISAG Pulse est une interface web intuitive qui :
- Centralise les projets par ministère, région et secteur  
- Affiche leur avancement en temps réel via une timeline interactive  
- Évalue leur transparence grâce à un score dynamique  
- Vulgarise les données via un module pédagogique intégré  
- Intègre un espace de feedback et de vote citoyen  
- Génère automatiquement des rapports personnalisés pour les agents publics

---

## 4. Modules fonctionnels

| Module              | Fonction                                         |
|---------------------|--------------------------------------------------|
| Tableau de bord     | Vue synthétique des projets actifs               |
| Fiche projet        | Objectifs, budget, avancement, responsable       |
| Timeline interactive| Frise cliquable avec jalons, retards, livrables  |
| Score de transparence| Calcul automatique basé sur complétude, délais, feedback |
| Historique          | Projets terminés, filtres temporels et géographiques |
| Espace citoyen      | Feedback, signalement, vote sur les projets      |
| SISAG Academy       | Mini-module d’éducation civique (infographies, quiz) |
| Rapports automatiques| Génération de rapports PDF pour les ministères  |
| Journal d’audit (optionnel)| Historique des modifications par agent et date |

---

## 5. Analyse du marché
- **Contexte** : La RDC modernise son administration via le PAG 2024–2028  
- **Besoin** : Suivi rigoureux, transparence, coordination et implication citoyenne  
- **Offre actuelle** : Peu d’outils combinent pédagogie, participation et rigueur  
- **Opportunité** : Le SISAG est une priorité nationale, soutenue par l’État  

---

## 6. Marché cible

| Segment              | Besoins                                |
|----------------------|----------------------------------------|
| Citoyens             | Comprendre, suivre, signaler, voter    |
| Agents publics       | Suivre, documenter, rapporter          |
| Journalistes / ONG   | Accéder aux données fiables            |
| Développeurs / chercheurs | Exploiter les données via API (phase 2) |

---

## 7. Proposition marketing
- **Nom évocateur** : SISAG Pulse – le rythme de l’action publique  
- **Design inclusif** : Mobile-first, multilingue, accessible  
- **Communication pédagogique** : Vulgarisation, pictogrammes, infographies  
- **Diffusion** : Portail gouvernemental, réseaux sociaux, SMS  

---

## 8. Valeur ajoutée

| Atout                | Détail                                   |
|----------------------|------------------------------------------|
| Pédagogie intégrée   | Fiches explicatives, quiz, infographies  |
| Participation active | Feedback citoyen + analyse intelligente  |
| Transparence renforcée| Timeline, score de transparence, journal d’audit |
| Accessibilité universelle| Design épuré, mobile, langues locales |
| Utilité administrative| Rapports automatiques, gain de temps    |
| Vision long terme    | API ouverte, carte d’impact réel, SIG (phase 2) |

---

## 9. Business Model Canva

| Bloc                 | Contenu                                  |
|----------------------|------------------------------------------|
| Segments clients     | Citoyens, agents publics, ONG, journalistes |
| Proposition de valeur| Interface intuitive, pédagogique, participative |
| Canaux               | Web, mobile, SMS, réseaux sociaux        |
| Relations clients    | Auto-service, feedback intégré, vulgarisation |
| Sources de revenus   | Subventions publiques, partenariats, API premium (phase 2) |
| Ressources clés      | Développement web, UX design, contenu pédagogique |
| Activités clés       | Conception, développement, tests, communication |
| Partenaires clés     | Ministères, ADIS, DFA, ONG locales       |
| Structure de coûts   | Développement, hébergement, maintenance, communication |

---

## 10. Conclusion
SISAG Pulse est une solution complète, réaliste et ambitieuse.  
Elle répond aux besoins stratégiques du SISAG RDC tout en apportant une touche unique : pédagogie, transparence dynamique et participation citoyenne intelligente.  
Réalisable en solo, elle est conçue pour être prototypée rapidement, tout en étant évolutive et impactante à long terme.

---

# Architecture de l’application SISAG Pulse

## Pages principales
1. **Page d’accueil (/)**  
   - Présentation du projet SISAG Pulse  
   - Bouton “Accéder au tableau de bord”  
   - Statistiques globales (nombre de projets, taux de transparence moyen)  

2. **Tableau de bord (/dashboard)**  
   - Liste des projets actifs  
   - Filtres par ministère, région, secteur  
   - Indicateurs clés : avancement, score de transparence, statut  

3. **Fiche projet (/project/:id)**  
   - Détails du projet : objectifs, budget, responsable, localisation  
   - Timeline interactive avec jalons cliquables  
   - Score de transparence calculé automatiquement  
   - Bouton “Donner un avis” (redirige vers l’espace citoyen)  

4. **Timeline interactive**  
   - Jalons atteints  
   - Retards signalés  
   - Livrables attendus  
   - Couleurs : vert (ok), orange (retard), rouge (bloqué)  

5. **Score de transparence**  
   - Basé sur complétude, délais, feedback citoyen  
   - Affiché sous forme de jauge ou note (ex : 82/100)  

6. **SISAG Academy (/academy)**  
   - Infographies sur le fonctionnement de l’État  
   - Quiz interactifs  
   - Glossaire des termes publics  

7. **Espace citoyen (/citizen)**  
   - Formulaire de feedback  
   - Vote pour les projets prioritaires  
   - Signalement de retards ou incohérences  

8. **Rapports automatiques (/reports)**  
   - Génération de rapports PDF  
   - Sélection de projet + période  
   - Aperçu du rapport avec graphiques  

9. **Historique des projets (/history)**  
   - Liste des projets terminés  
   - Filtres par année, région, ministère  
   - Statistiques d’impact  

10. **Journal d’audit (optionnel, admin only)**  
   - Historique des modifications  
   - Qui a modifié quoi, quand  

---

## Structure générale (Blade Views)

| Page                  | URL             | Fonction principale                        |
|-----------------------|-----------------|--------------------------------------------|
| home.blade.php        | /               | Présentation du projet + stats globales    |
| dashboard.blade.php   | /dashboard      | Vue synthétique des projets actifs         |
| project.blade.php     | /project/{id}   | Fiche projet + timeline + score            |
| academy.blade.php     | /academy        | Module pédagogique (infographies, quiz)    |
| citizen.blade.php     | /citizen        | Espace de feedback et vote citoyen         |
| reports.blade.php     | /reports        | Génération de rapports PDF                 |
| history.blade.php     | /history        | Liste des projets terminés                 |
| admin/audit.blade.php | /admin/audit    | Journal des modifications (admin)          |

---

## Contrôleurs

| Contrôleur            | Rôle                                   |
|-----------------------|----------------------------------------|
| ProjetController      | CRUD des projets, affichage tableau de bord |
| TimelineController    | Gestion des jalons, retards, livrables |
| TransparenceController| Calcul du score                        |
| CitoyenController     | Feedback, votes, signalements          |
| AcademyController     | Contenus pédagogiques                  |
| RapportController     | Génération de rapports PDF             |
| HistoriqueController  | Liste des projets terminés             |
| AuditController (opt.)| Journal des modifications              |

---

## Routes Web (Laravel)

```php
Route::get('/', [ProjetController::class, 'home']);
Route::get('/dashboard', [ProjetController::class, 'index']);
Route::get('/project/{id}', [ProjetController::class, 'show']);
Route::get('/academy', [AcademyController::class, 'index']);
Route::get('/citizen', [CitoyenController::class, 'index']);
Route::post('/citizen/feedback', [CitoyenController::class, 'storeFeedback']);
Route::get('/reports', [RapportController::class, 'index']);
Route::post('/reports/generate', [RapportController::class, 'generate']);
Route::get('/history', [HistoriqueController::class, 'index']);
Route::get('/admin/audit', [AuditController::class, 'index']); // optionnel

## Base de données (tables principales)

| Table               | Champs clés                                                   |
|---------------------|---------------------------------------------------------------|
| projects            | id, titre, ministère, budget, statut, score_transparence      |
| timelines           | id, project_id, jalon, date, état                             |
| feedbacks           | id, project_id, nom_citoyen, commentaire, type (vote/signalement) |
| reports             | id, project_id, période, contenu_pdf                          |
| audit_logs (optionnel) | id, user_id, action, date                                  |