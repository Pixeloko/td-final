<?php

require_once __DIR__ . "/../config/config.php";


/**
 * Récupérer les données d'une publication avec son id
 * @param $id id de la publication
 * @return array ou rien si non trouvée
 */
function getPostById(int $id): ?array {
    $conn = getDatabase();

    $stmt = $conn->prepare("SELECT * FROM publication WHERE id = :id");
    $stmt->execute(["id" => $id]);

    return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
}

/**
 * Récupérer toutes données de toutes les publications
 * @return array ou rien si non trouvée
 */
function getPost(): ?array {

    $conn = getDatabase();

    $stmt = $conn->prepare("SELECT * FROM publication");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/* Not used ATM-------------------------------------------------------------------------------
/**
 * Récupérer les données d'une publication avec son id
 * @param $userId id de l'user
 * @return array avec les publications d'un utilisateur

function getPostByUser(string $userId): array {  

    $conn = getDatabase();
    
    $stmt = $conn->prepare("SELECT * FROM publication WHERE user_id = :userId");
    $stmt->execute([
        "userId" => $userId
    ]);
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
*/

/**
 * Met à jour le statut de publication d'une publication
 * @param int $postId L'identifiant de la publication à modifier
 * @param int $published Le nouveau statut de publication (0 pour non publié, 1 pour publié)
 * @return bool Retourne true si la mise à jour a réussi, false sinon
 */
function markPostAsPublished(int $postId, int $published): bool {

    $conn = getDatabase();

    $stmt = $conn->prepare("UPDATE publication SET is_published = :published WHERE id = :postId");

    return $stmt->execute([
        "postId" => $postId,
        "published" => $published
    ]);
}

/**
 * Création d'un post
 * @param string $title
 * @param string $description 
 * @param int $picturePath
 * @return int retourne l'id de la publication créée
 */
function createPost(string $title, string $description, string $picturePath): int 
{
    $conn = getDatabase();

    $stmt = $conn->prepare("
        INSERT INTO publication (title, description, picture)
        VALUES (:title, :description, :picture)
    ");

    $stmt->execute([
        "title" => $title,
        "description" => $description,
        "picture" => $picturePath
    ]);

    return (int)$conn->lastInsertId();
}


/**
 * Modification du post
 * @return bool 1 si succès, 0 si rien ne s'est passé
 */
function updateProduct(int $postId, string $name, string $description, string $picturePath): bool {
    
    $conn = getDatabase();


    $stmt = $conn->prepare("UPDATE publication SET title = :title, picture = :picture, description = :description WHERE id = :id");

    $stmt->execute([
        "id" => $postId,
        "title" => $title,
        "picture" => $picturePath,
        "description" => $description
    ]);

    return $stmt->rowCount() > 0;
}

function getPostPublished(): ?array {

    $conn = getDatabase();

    $stmt = $conn->prepare("SELECT * FROM publication WHERE is_published = 1");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
