<?php

include_once "../config.php";

function getPostById(int $id): ?array {
    $conn = getDatabase();

    $stmt = $conn->prepare("SELECT * FROM publication WHERE id = :id");
    $stmt->execute(["id" => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

function getPostNotPublished() {
    $conn = getDatabase();
    $stmt = $conn->prepare("SELECT * FROM publication WHERE is_published = 0");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPostPublished(): ?array {

    $conn = getDatabase();

    $stmt = $conn->prepare("SELECT * FROM publication WHERE is_published = 1");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPostByUser(string $userId): array {  

    $conn = getDatabase();
    
    $stmt = $conn->prepare("SELECT * FROM publication WHERE user_id = :userId");
    $stmt->execute([
        "userId" => $userId
    ]);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function markPostAsPublished(int $postId): bool {

    $conn = getDatabase();

    $stmt = $conn->prepare("UPDATE publication SET is_published = :published WHERE id = :postId");

    return $stmt->execute([
        "postId" => $postId,
        "published" => $published
    ]);
}
function createPost(string $title, string $description, string $picturePath): int {

    $conn = getDatabase();

    $stmt = $conn->prepare("INSERT INTO publication (title, description, picture, datetime)
                            VALUES (:title, :description, :picture, NOW())");

    $stmt->execute([
        "title" => $title,
        "description" => $description,
        "picture" => $picturePath
    ]);

    return (int) $conn->lastInsertId();
}


function deletePost(int $postId): bool {

    $conn = getDatabase();

    $stmt = $conn->prepare("DELETE FROM publication WHERE id = :postId");
    $stmt->execute([
        "postId" => $postId
    ]);

    return $stmt->rowCount() > 0;
}

function updateProduct(int $postId, string $name, string $description, string $picturePath): bool {
    
    $conn = getDatabase();


    $stmt = $conn->prepare("UPDATE publication SET title = :title, description = :description, picture = :picture WHERE id = :id");

    $stmt->execute([
        "id" => $postId,
        "title" => $title,
        "description" => $description,
        "picture" => $picturePath
    ]);

    return $stmt->rowCount() > 0;
}
?>

