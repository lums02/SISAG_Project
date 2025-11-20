# SISAG Pulse
Le rythme de l’action publique, en temps réel

## Présentation
SISAG Pulse est une interface web interactive conçue pour accompagner la transformation numérique de l’administration publique congolaise.  
Elle permet de visualiser, comprendre, évaluer et vulgariser les projets gouvernementaux, tout en facilitant la coordination entre institutions et l’accès citoyen à l’information.

## Problématique
Malgré les efforts de digitalisation, plusieurs défis persistent :
- Données dispersées entre ministères
- Suivi peu lisible et difficilement accessible
- Retards ou blocages non anticipés
- Faible implication citoyenne
- Absence d’outils pédagogiques pour vulgariser l’action publique

## Solution proposée
SISAG Pulse apporte une réponse concrète grâce à :
- Un tableau de bord centralisé
- Des timelines interactives pour suivre l’avancement
- Un score de transparence dynamique
- Un module pédagogique (SISAG Academy)
- Un espace citoyen pour feedback et votes
- La génération automatique de rapports pour les agents publics

## Fonctionnalités principales
- Tableau de bord : vue synthétique des projets actifs
- Fiche projet : objectifs, budget, avancement, responsable
- Timeline interactive : jalons, retards, livrables
- Score de transparence : calcul basé sur complétude, délais et feedback
- Historique : projets terminés avec filtres temporels et géographiques
- Espace citoyen : feedback, signalement, vote
- SISAG Academy : infographies, quiz, glossaire
- Rapports automatiques : génération de PDF pour les ministères
- Journal d’audit (optionnel) : suivi des modifications par agent

## Technologies utilisées
- Backend : Laravel (PHP)
- Frontend : Blade + JavaScript
- Base de données : MySQL / MariaDB
- Design : Tailwind CSS ou Bootstrap
- Rapports PDF : DomPDF ou Snappy

## Installation
1. Cloner le dépôt :
   ```bash
   git clone https://github.com/tonpseudo/SISAG-Pulse.git
2. Installer les dépendances :
   composer install
   npm install
3.  Configurer l’environnement :
   cp .env.example .env
   php artisan key:generate
4. Lancer le serveur :
   php artisan serve

