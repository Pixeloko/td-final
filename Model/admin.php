<?php

require_once __DIR__ . "/../config/config.php";

function getPostNotPublished() {
    $conn = getDatabase();
    $stmt = $conn->prepare("SELECT * FROM publication WHERE is_published = 0");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
?>