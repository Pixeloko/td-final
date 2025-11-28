<?php

include_once "./config.php";

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

    $stmt = $conn->prepare("UPDATE publication SET published = :published WHERE id = :postId");

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
function createPost(string $title, string $description, string $picturePath): int {
    $conn = getDatabase();

    // Création de la date au format France avec le bon fuseau horaire
    date_default_timezone_set('Europe/Paris');
    $datetime = date('Y-m-d H:i');
    
    // Modification de la requête pour inclure is_published
    $stmt = $conn->prepare("INSERT INTO publication (title, picture, description, datetime, is_published)
                            VALUES (:title, :picture, :description, :datetime, 1)");
    
    $params = [
        "title" => $title,
        "picture" => $picturePath,
        "description" => $description,
        "datetime" => $datetime
    ];

    $stmt->execute($params);

    return $conn->lastInsertId();
}

/**
 * Supprimer une publication avec son id
 *  @param int $postId Id du post à supprimer 
 * @return bool 1 si un changement a été fait (la supression a fonctionnée, 0 sinon)
 */
function deletePost(int $postId): bool {

    $conn = getDatabase();

    $stmt = $conn->prepare("DELETE FROM publication WHERE id = :postId");
    $stmt->execute([
        "postId" => $postId
    ]);

    return $stmt->rowCount() > 0;
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
?>
