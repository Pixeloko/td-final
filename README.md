# TP FINAL

Création d'un site similaire à Instagram.

## Structure 

tp-final/
   ├── assets/              
   │   ├── css/             # (Bilel)
   │   └── uploads/         # Images uploadées (Yesil-maker)
   ├── index.php            # Arrivée de l'utilisateur
   ├── publier.php          
   ├── Controller/         # Les fonctions pour gérer la base de données (Pixeloko)
   │   ├── post.php
   │   └── user.php
   ├── Model/              
   │   └── PublicationModel.php
   ├── View/               # Les html/formulaires
   │   ├── home.php          # Vue par défaut
   │   └── publish.php       # Formulaire de publication
   │
   ├── config/               
   │     └── database.sql     # (Pixeloko)
   └──.htaccess (#Pixeloko)
