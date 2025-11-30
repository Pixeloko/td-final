<?php
require_once "header.php";
require_once __DIR__ . "/../controllers/admin.php";
require_once __DIR__ . "/../config/config.php";

// Génération du token 
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

?>

<main>
    <?php if (isset($_SESSION["message"])): ?>
    <div style="color: green"><?=  htmlspecialchars($_SESSION["message"]) ?></div>
    <?php unset($_SESSION["message"]) ?>
    <?php endif ?>
    <h1>Admin Dashboard</h1>
    <h2>Publications en attente de validation</h2>

    <?php if (count($posts) === 0): ?>
    <p>Il n'y a aucune publication</p>
    <?php else: ?>
    <table border=1>
        <thead>
            <tr>
                <th>Publication</th>
                <th>Date du post</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($posts as $post): ?>
            <tr>
                <td><?= htmlspecialchars($post["title"]) ?></td>
                <td><?= htmlspecialchars($post["datetime"]) ?></td>

                <td>
                    <form method="GET" action="../accepter_post.php">
                        <input type="hidden" name="post" value="<?= htmlspecialchars($post['id']) ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <button type="submit">Accepter</button>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $post["id"] ?>">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        <button type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach?>
        </tbody>
    </table>
    <?php endif ?>
</main>
