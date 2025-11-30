# TP FINAL

Création d'un site similaire à Instagram.

## Structure 

td-final/
   ├── assets/              
   │   ├── style.css        # (Bilal)
   │   └── uploads/         # Images uploadées (Yesil)
   ├── index.php            # Page de redirections         
   ├── controllers/         # Les fonctions pour gérer la base de données (Pixeloko)
   │   └── user.php          # (Yesil) non utilisée
   │   └── admin.php         # PHP gèrant la view admin (Yesil)
   │   └── publish.php       # PHP gèrant la view admin (Pixeloko)
   ├── Model/              
   │   └── publish.php       # Fonctions pour les publications (Yesil)
   │   └── user.php          # Fonctions pour gestion des users (non utilisées) (Yesil + Bilal)
   │   └── admin.php         # Fonctions delete/modifications (Bilal)
   ├── View/                 # Les html/formulaires
   │   ├── home.php          # Vue par défaut (Bilal)
   │   ├── header.html       # Bilal
   |   ├── admin.php         # Page pour deletion/modification (Yesil)
   │   └── publish.php       # Formulaire de publication
   │
   ├── config/  
   |   ├── config.php       # Connexion BDD     
   │   └── database.sql     # (Pixeloko)
   └──.htaccess             
