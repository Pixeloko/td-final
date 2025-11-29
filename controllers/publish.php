<?php
require_once __DIR__ . "/../Model/publish.php";

session_start();

// Générer le token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$errors = [];
$title = "";
$description = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Vérification du token
    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("CSRF token invalide");
    }

    // Inputs
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");

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

        $extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $filename = time() . "_" . bin2hex(random_bytes(8)) . "." . $extension;

        $targetFile = $uploadDir . $filename;

        // Vérifications du type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $detectedType = finfo_file($fileInfo, $_FILES["image"]["tmp_name"]);
        finfo_close($fileInfo);

        if (!in_array($detectedType, $allowedTypes)) {
            $errors[] = "Seuls les fichiers JPEG, PNG et GIF sont autorisés.";
        }
        elseif (!in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            $errors[] = "Extension de fichier non autorisée.";
        }
        elseif ($_FILES["image"]["size"] > 5000000) {
            $errors[] = "Le fichier est trop volumineux (max 5Mo).";
        }

        // Placement du fichier
        if (empty($errors)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $picturePath = "assets/uploads/" . $filename;
            } else {
                $errors[] = "Le téléversement a échoué.";
            }
        }

    } else {
        // Aucun fichier envoyé → image obligatoire
        $errors[] = "Rentrer une image.";
    }

    // Création du post
    if (empty($errors)) {
        $id = createPost($title, $description, $picturePath);

        if (!empty($id)) {
            markPostAsPublished($id, 1);
            header("Location: ../View/home.php");
            exit;
        } else {
            $errors[] = "Erreur de la base de donnée.";
        }
    }
}
?>
