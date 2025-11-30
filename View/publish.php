<?php 
    require_once __DIR__ . "/../controllers/publish.php";
    require_once "header.php"; 
?>

<main>
    <h1>Publier une nouvelle photo</h1>

    <?php if (!empty($errors)): ?>
        <div class="errors" style="color:red;">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div>
            <label for="image">Image :</label>
            <input type="file" name="image" required>
        </div>

        <div>
            <label for="title">Titre :</label>
            <input type="text" name="title" value="<?= htmlspecialchars($title) ?>" required>
        </div>

        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

        <div>
            <label for="description">Description :</label>
            <textarea name="description"><?= htmlspecialchars($description) ?></textarea>
        </div>

        <button type="submit">Publier</button>
    </form>
</main>
