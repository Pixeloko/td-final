<?php
require_once __DIR__ . "/View/header.php";
require_once __DIR__ . "/config/config.php";

$errors = [];
$email = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    if (
        !isset($_POST['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("❌ CSRF token invalide");
    }
    
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Veuillez entrer un email valide";
    }

    if (empty($password)) {
        $errors["password"] = "Le mot de passe est requis";
    }


    if (empty($errors)) {
        $pdo = getDatabase();
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->execute(["email" => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user || !password_verify($password, $user["password"])) {
                $errors["general"] = "❌ Identifiants invalides";
            } else {
                $_SESSION["user_id"] = $user["id"];
                $_SESSION["message"] = "✅ Connexion réussie !";
                $_SESSION["role"] = $user["role"];
                header("Location: ./View/home.php");
                exit;
            }
        } catch (PDOException $e) {
            $errors["general"] = "Une erreur s'est produite. Veuillez réessayer plus tard";
        }
    }
}
?>

<form method="POST">
    <?php if (isset($errors["general"])): ?>
        <div style="color: red"><?= htmlspecialchars($errors["general"]) ?></div>
    <?php endif ?>

    <h1>Connexion</h1>

    <div>
        <label for="email">Email (requis) :</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" required />
        <?php if (isset($errors["email"])): ?>
            <p style="color: red"><?= htmlspecialchars($errors["email"]) ?></p>
        <?php endif ?>
    </div>

    <div>
        <label for="password">Mot de passe (requis) :</label>
        <input type="password" name="password" id="password" required />
        <?php if (isset($errors["password"])): ?>
            <p style="color: red"><?= htmlspecialchars($errors["password"]) ?></p>
        <?php endif ?>
    </div>
    <div>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
    </div>

    <button type="submit">Se connecter</button>
</form>

