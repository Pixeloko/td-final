<?php
// Connexion à la base de données (adaptez les valeurs)
$host = 'localhost';
$dbname = 'votrebasededonnees';
$username = 'votreutilisateur';
$password = 'votremotdepasse';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire de signalement (si soumis)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report_id'])) {
    $reportId = (int) $_POST['report_id'];
    // Mettre à jour is_published à false
    $stmt = $pdo->prepare("UPDATE publications SET is_published = false WHERE id = ?");
    $stmt->execute([$reportId]);
    // Redirection pour éviter la resoumission du formulaire
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Récupérer les publications publiées
$stmt = $pdo->query("SELECT id, title, description, image_url FROM publications WHERE is_published = true ORDER BY id DESC");
$publications = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications Publiées</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Publications </h1>
        <?php if (empty($publications)): ?>
            <p>Aucune publication publiée pour le moment.</p>
        <?php else: ?>
            <div class="row">
                <?php foreach ($publications as $pub): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <?php if ($pub['image_url']): ?>
                                <img src="<?php echo htmlspecialchars($pub['image_url']); ?>" class="card-img-top" alt="Image de la publication">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($pub['title']); ?></h5>
                                <p class="card-text"><?php echo htmlspecialchars($pub['description']); ?></p>
                                <form method="POST" action="">
                                    <input type="hidden" name="report_id" value="<?php echo $pub['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Signaler</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
