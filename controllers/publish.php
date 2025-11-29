<?php
require_once __DIR__ . "/../Model/publish.php";

$errors = [];
$title = "";
$description = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Prendre les inputs
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");

    // Validation du titre obligatoire
    if ($title === "") {
        $errors[] = "Le titre est requis.";
    }

    // Gestion du fichier
    $picturePath = null;

    if (!empty($_FILES["image"]["name"])) {

        $uploadDir = __DIR__ . "/../assets/uploads/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $uploadDir . $filename;

        // Vérifications du type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $detectedType = finfo_file($fileInfo, $_FILES["image"]["tmp_name"]);
        
        if (!in_array($detectedType, $allowedTypes)) {
            $errors[] = "Seuls les fichiers JPEG, PNG et GIF sont autorisés.";
        }
        // Vérifier l'extension
        elseif (!in_array(strtolower(pathinfo($filename, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) {
            $errors[] = "Extension de fichier non autorisée.";
        }
        // Vérifier la taille
        elseif ($_FILES["image"]["size"] > 5000000) {
            $errors[] = "Le fichier est trop volumineux (max 5Mo).";
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $picturePath = "assets/uploads/" . $filename;
        } else {
            $errors[] = "Le téléversement a échoué.";
        }
    } else {
        $errors[] = "Une image est requise.";
    }

    // Pas d'erreur = création du post
    if (empty($errors)) {
        $id = createPost($title, $description, $picturePath);

        if (!empty($id)) {
            // On met la publication comme published
            markPostAsPublished($id, 1);    
            header("Location: ../View/home.php");
            exit;
        } else {
            $errors[] = "Erreur de la base de donnée.";
        }
    }
}
?>
