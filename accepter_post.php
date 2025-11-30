<?php
require_once "controllers/post.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$postId = $_GET["post"] ?? null;

try {
    $completePost = markPostAsPublished($postId);
    $_SESSION["message"] = "✅ Tâche complétée avec succès";
    header("Location: dashboard.php");
    exit;
} catch (Exception $e) {
    $_SESSION["message"] = "❌ Erreur : " . $e->getMessage();
    header("Location: admin.php");
    exit;
}