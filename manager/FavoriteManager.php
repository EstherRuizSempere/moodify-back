<?php

include_once __DIR__ . '/../config/ConnectionDB.php';

class FavoriteManager
{
    private $pdo;

    public function __construct()
    {
        $conexion = new ConnectionDB();
        $this->pdo = $conexion->connect();
    }

    public function addFavorite(int $userId, string $trackId): void
    {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO favorites (user_id, track_id, added_at)
                VALUES (:user_id, :track_id, NOW())
                ON DUPLICATE KEY UPDATE added_at = NOW()
            ");
            $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindValue(':track_id', $trackId);
            $stmt->execute();
        } catch (PDOException $e) {
            throw new \Exception("Error al añadir favorito: " . $e->getMessage());
        }
    }

    public function removeFavorite(int $userId, string $trackId): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM favorites WHERE user_id = :user_id AND track_id = :track_id");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':track_id', $trackId);
        $stmt->execute();
    }

    public function listFavorites(int $userId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT track_id, added_at
            FROM favorites
            WHERE user_id = :user_id
            ORDER BY added_at DESC
        ");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); // devuelve [{track_id, added_at}]
    }
}
