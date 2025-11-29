# TP FINAL

Création d'un site similaire à Instagram.

## Structure 

tp-final/
   ├── assets/              
   │   ├── style.css        # (Bilel)
   │   └── uploads/         # Images uploadées (Yesil)
   ├── index.php            # Page de redirections         
   ├── controllers/         # Les fonctions pour gérer la base de données (Pixeloko)
   │   └── user.php
   │   └── admin.php         # PHP gèrant la view admin
   │   └── publish.php
   ├── Model/              
   │   └── publish.php       # Fonctions pour les publications (Yesil)
   │   └── admin.php         # Fonctions delete/modifications (Bilel)
   ├── View/                 # Les html/formulaires
   │   ├── home.php          # Vue par défaut
   |   ├── admin.php          
   │   └── publish.php       # Formulaire de publication
   │
   ├── config/               
   │     └── database.sql     # (Pixeloko)
   └──.htaccess               # (Pixeloko)
