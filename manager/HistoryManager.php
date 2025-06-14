<?php

include_once __DIR__ . '/../config/ConnectionDB.php';

class HistoryManager
{
    private $pdo;

    public function __construct()
    {
        $conexion = new ConnectionDB();
        $this->pdo = $conexion->connect();
    }

    public function addHistory($userId, $trackId)
    {
        $stmt = $this->pdo->prepare("INSERT INTO history (user_id, track_id) VALUES (:user_id, :track_id)");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':track_id', $trackId);
        $stmt->execute();
    }

    public function listHistory($userId, $limit = 10)
    {
        $stmt = $this->pdo->prepare("SELECT track_id, played_at FROM history WHERE user_id = :user_id ORDER BY played_at DESC LIMIT :limit");
        $stmt->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
