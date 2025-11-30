<?php
require_once __DIR__ . "/../Model/publish.php";
require_once __DIR__ . "/../Model/admin.php";
session_start();

$errors = [];
$title = "";
$description = "";

// Génère un token CSRF si absent
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Vérification token CSRF
    if (!isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("CSRF token invalide");
    }

    // Champs texte
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");

    if ($title === "") $errors[] = "Le titre est requis.";

    // Upload de l’image
    $picturePath = null;

    if (!empty($_FILES["image"]["name"])) {
        $uploadDir = __DIR__ . "/../assets/uploads/";
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $extension = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $filename = time() . "_" . bin2hex(random_bytes(8)) . "." . $extension;
        $targetFile = $uploadDir . $filename;

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/avif'];
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $detectedType = finfo_file($fileInfo, $_FILES["image"]["tmp_name"]);
        finfo_close($fileInfo);

        if (!in_array($detectedType, $allowedTypes))
            $errors[] = "Seuls JPEG, PNG, GIF, AVIF sont autorisés.";

        if ($_FILES["image"]["size"] > 5000000)
            $errors[] = "Image trop volumineuse (5 Mo max).";

        if (empty($errors)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $picturePath = "assets/uploads/" . $filename;
            } else {
                $errors[] = "Erreur lors du téléversement.";
            }
        }
    } else {
        $errors[] = "Rentrer une image.";
    }

    if (empty($errors)) {
        $id = createPost($title, $description, $picturePath);

        if ($id > 0) {
            getPostNotPublished();
            header("Location: ../View/admin.php?success=1");
            exit;
        } else {
            $errors[] = "Erreur en base de données.";
        }
    }
}
