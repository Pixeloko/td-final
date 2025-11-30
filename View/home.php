<?php
require_once "header.php";
require_once __DIR__ . "/../Model/publish.php";
require_once __DIR__ . "/../config/config.php";

    try {
        $posts = getPostPublished();
    } catch (Exception $e) {
        echo "Erreur lors de la récupération des publications : " . $e->getMessage();
    }
?>

    <h1>Bienvenue sur la page d'accueil</h1>

    <?php if (count($posts) === 0): ?>
        <p>Aucune publication n'a été trouvée.</p>
    <?php else: ?>
        <div>
            <?php foreach ($posts as $post): ?>
                <div class="post">
                    <h2><?= htmlspecialchars($post['title']) ?></h2>
                    <p><?= htmlspecialchars($post['description']) ?></p>
                    <?php if ($post['picture']): ?>
                        <img src="../<?= htmlspecialchars($post['picture']) ?>"alt="<?= htmlspecialchars($post['title']) ?>" style="max-width:100%;">
                    <?php else: ?>
                        <p>Aucune image disponible</p>
                    <?php endif ?>
                    <p class="date">Publié le <?= $post['datetime'] ?></p>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif ?>