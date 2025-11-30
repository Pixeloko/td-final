<?php require_once("./controllers/publish.php"); 
require_once "header.php";?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Publier une nouvelle photo</title>
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body>
    <h1>Publier une nouvelle photo</h1>

    <?php if (!empty($errors)): ?>
        <div class="errors">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form action="./controllers/publish.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="image">Image*</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="title">Titre*</label>
            <input type="text" id="title" name="title" 
                   value="<?= htmlspecialchars($title) ?>" 
                   required>
        </div>
        <div>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" 
                      rows="4"><?= htmlspecialchars($description) ?></textarea>
        </div>

        <button type="submit">Publier</button>
    </form>
</body>
</html>