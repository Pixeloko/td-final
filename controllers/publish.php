<?php
require_once __DIR__ . "/../Model/publish.php";

$errors = [];
$title = "";
$description = "";

// If form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Get fields
    $title = trim($_POST["title"] ?? "");
    $description = trim($_POST["description"] ?? "");

    // Validate fields
    if ($title === "") {
        $errors[] = "Title is required.";
    }
    if ($description === "") {
        $errors[] = "Description is required.";
    }

    // Handle file
    $picturePath = null;

    if (!empty($_FILES["image"]["name"])) {

        $uploadDir = __DIR__ . "/../assets/uploads/";

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filename = time() . "_" . basename($_FILES["image"]["name"]);
        $targetFile = $uploadDir . $filename;

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            $picturePath = "assets/uploads/" . $filename;
        } else {
            $errors[] = "Image upload failed.";
        }
    } else {
        $errors[] = "An image is required.";
    }

    // No errors → Insert publication
    if (empty($errors)) {
        if (createPost($title, $description, $picturePath)) {
            header("Location: ../View/home.php");
            exit;
        } else {
            $errors[] = "Database error.";
        }
    }
}
?>
