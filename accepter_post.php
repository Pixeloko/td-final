<?php
require_once __DIR__ . "/model/publish.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$postId = $_GET["post"] ?? null;

try {
    $completePost = markPostAsPublished($postId, 1);
    $_SESSION["message"] = "Publication validée avec succès";
    header("Location: View/admin.php");
    exit;
} catch (Exception $e) {
    $_SESSION["message"] = "❌ Erreur : " . $e->getMessage();
    header("Location: admin.php");
    exit;
}
