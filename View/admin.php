<?php 
    include_once "header.php";
    include_once "../controllers/allcontrollers.php";

//    if (!isset($_SESSION['user_id']) || $_SESSION['admin'] != 1) {
//        header("Location: home.php");
//        exit;
//    }

    $posts = getPostNotPublished();

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $postId = $_POST["id"] ?? null;
        if ($postId) {
            deletePost($postId);
            $_SESSION["message"] = "Tâche supprimée avec succès";
            header("Location: admin.php");
            exit;
        }
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
                            <form method="GET" action="accepter_post.php">
                                <input type="hidden" name="post" value="<?= htmlspecialchars($post['id']) ?>">
                                <button type="submit">Accepter</button>
                            </form>
                            <form method="POST">
                                <input type= "hidden" name="id" value="<?= $post["id"] ?>">
                                <button type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    <?php endif ?>
</main>
