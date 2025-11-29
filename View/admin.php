<?php 
    require_once "view/header.php";
    require_once "controllers/allcontrollers.php";

    if (!isset($_SESSION['user_id']) || $_SESSION['admin'] != 1) {
        header("Location: index.php");
        exit;
    }

    $posts = getPostNotPublished();
?>

<main>
    <?php if (count($post) === 0): ?>
        <p>Il n'y a aucune publication</p>
    <?php else: ?>
        <table border = 1>
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
                        <td><?= $post["title"] ?></td>
                        <td><?= formatDate($post["created_at"]) ?></td>
                        <td>
                            <form class="btn_dash" method="GET" action="updateTask.php">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($post['id']) ?>">
                                <button type="submit">Accepter</button>
                            </form>
                            <form method="POST" action="completeTask.php?task=<?= htmlspecialchars($post['id']) ?>">
                                <button>Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    <?php endif ?>
</main>