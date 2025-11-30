<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../assets/style.css" rel="stylesheet">
</head>
<body>
<header>
    <nav>
    <a href="home.php">Accueil</a>

    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="../logout.php">Déconnexion</a>
        <a href="admin.php">Espace Admin</a>
        <a href="publish.php">Créer un post</a>
    <?php else: ?>
        <a href="login.php">Connexion</a>
    <?php endif; ?>
</nav>
</header>
    

