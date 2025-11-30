<?php
declare(strict_types=1);

const DB_HOST = '127.0.0.1';
const DB_NAME = 'tpFinal';
const DB_USER = 'root';
const DB_PASSWORD = 'password';

/**
 * Créer le PDO pour se connecter à la BDD
 * @return PDO la configuration de connexion
 */
function getDatabase(): PDO
{
    static $conn = null;

    if ($conn === null) {
        try {
            $conn = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, 
                DB_USER, 
                DB_PASSWORD,                
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            // En production, logger l'erreur au lieu de l'afficher
            error_log($e->getMessage());
            die('❌ Erreur de connexion à la base de données');
        }
    }

    return $conn;
}