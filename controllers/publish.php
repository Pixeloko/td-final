<?php
require_once __DIR__ . "/../Model/publish.php";

$errors = [];
$title = "";
$description = "";

// If form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get fields
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");

    // Validate fields
    if ($title === "") {
        $errors[] = "Title is required.";
    }
    if ($description === "") {
        $errors[] = "Description is required.";
    }

    // Handle file
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
            $errors[] = "Image upload failed.";
        }
    } else {
        $errors[] = "An image is required.";
    }

    // No errors → Insert publication
    if (empty($errors)) {
        if (createPost($title, $description, $picturePath)) {
            header("Location: ../View/home.php");
            exit;
        } else {
            $errors[] = "Database error.";
        }
    }
}
?>
