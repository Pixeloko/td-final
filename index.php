<?php

    $uri = isset($_GET['uri']) ? '/' . trim($_GET['uri'], '/') : '/';
    
    if ($uri === '/liste') {
        // require './Controller/';
    
    } else {
        echo 'Page non trouvée.';
    }
    
    require_once "./includes/header.php"

    try {
        posts = getPost();
    } catch (PDOException $e) {
            $errors["general"] = "Erreur : " . $e->getMessage();
        }
?>

<main>
    <?php if (isset($errors["general"])): ?>
        <div style="color:red"><?= htmlspecialchars($errors["general"]) ?></div>
    <?php endif ?>
    
</main>
