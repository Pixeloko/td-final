# TP FINAL – Mini Instagram

Création d'un site web similaire à Instagram permettant aux utilisateurs de publier des posts avec images, gérer leurs comptes et pour les administrateurs de valider ou supprimer des publications.

---

## Table des matières

- [Structure du projet](#structure-du-projet)
- [Fonctionnalités](#fonctionnalités)
- [Installation](#installation)
- [Contributeurs](#contributeurs)


## Structure du projet

td-final/
├── assets/
│ ├── style.css # Styles CSS (Bilal)
│ └── uploads/ # Images uploadées (Yesil)
├── index.php # Page de redirection / point d'entrée
├── controllers/ # Fonctions PHP pour gérer la logique et la base de données (Pixeloko)
│ ├── user.php # Gestion des utilisateurs (Yesil, non utilisée)
│ ├── admin.php # Gestion des actions admin (Yesil)
│ └── publish.php # Gestion des publications (Pixeloko)
├── Model/
│ ├── publish.php # Fonctions pour les publications (Yesil)
│ ├── user.php # Fonctions pour la gestion des utilisateurs (Yesil + Bilal)
│ └── admin.php # Fonctions pour delete/modification (Bilal)
├── View/ # Interfaces utilisateurs (HTML / PHP)
│ ├── home.php # Vue principale / fil d'actualité (Bilal)
│ ├── header.php # Header commun pour toutes les vues (Bilal)
│ ├── admin.php # Page admin pour suppression / validation (Yesil)
│ └── publish.php # Formulaire de création de publication
├── config/
│ ├── config.php # Connexion à la base de données
│ └── database.sql # Structure initiale de la BDD (Pixeloko)
└── .htaccess # Configuration Apache


---

## Fonctionnalités

- **Utilisateur**
  - Création de compte
  - Connexion / Déconnexion
  - Publication de posts avec titre, description et image
  - Visualisation des posts publiés

- **Administrateur**
  - Validation des publications
  - Suppression des publications
  - Gestion sécurisée via session et rôle admin

---

## Installation

1. git clone https://github.com/Pixeloko/td-final dans le /htdocs 
2. Importer `config/database.sql` dans MySQL pour créer la base de données et les tables.  
3. Configurer `config/config.php` avec les identifiants de la DB.  
4. Créer le dossier uploads dans assets afin d'acueillir les images

## Contributeurs
- Pixelolko Lola VANHAVERBEKE
- Yesil-maker Ilyès CHOUITER
- Bilel Bilal CHAYBOUTI
- Manuel BEKA