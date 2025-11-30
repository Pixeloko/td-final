<?php 
require_once __DIR__ . "/../Model/admin.php";
require_once __DIR__ . "/../config/config.php";

    $posts = getPostNotPublished();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $postId = $_POST["id"] ?? null;
        if ($postId) {
            deletePost($postId);
            $_SESSION["message"] = "Tâche supprimée avec succès";
            header("Location: ./View/admin.php");
            exit;
        }
    }
?>