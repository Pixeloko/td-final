# TP FINAL

Création d'un site similaire à Instagram.

## Structure 

tp-final/
   ├── assets/              
   │   ├── style.css        # (Bilel)
   │   └── uploads/         # Images uploadées (Yesil)
   ├── index.php            # Page de redirections         
   ├── controllers/          # Les fonctions pour gérer la base de données (Pixeloko)
   │   └── user.php
   │   └── publish.php
   ├── Model/              
   │   └── publish.php       # Fonctions pour les publications (Yesil)
   ├── View/                 # Les html/formulaires
   │   ├── home.php          # Vue par défaut
   │   └── publish.php       # Formulaire de publication
   │
   ├── config/               
   │     └── database.sql     # (Pixeloko)
   └──.htaccess               # (Pixeloko)
