<?php
require_once __DIR__ . "/../Model/admin.php";
require_once __DIR__ . "/../config/config.php";

// Vérifie que l'utilisateur est admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    http_response_code(403);
    die("Accès interdit");
}

// Liste des posts
$posts = getPostNotPublished();

// Vérification POST (suppression)
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Protection CSRF
    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("Invalid CSRF token");
    }

    $postId = $_POST["id"] ?? null;

    if ($postId) {
        deletePost($postId);
        $_SESSION["message"] = "Tâche supprimée avec succès";
        header("Location: /td-final/View/admin.php");
        exit;
    }
}
?>
