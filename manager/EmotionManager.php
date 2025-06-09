<?php
include_once __DIR__ . '/../config/ConnectionDB.php';
include_once __DIR__ . '/../entities/Emotion.php';

class EmotionManager
{
    private $pdo;

    public function __construct()
    {
        $conexion = new ConnectionDB();
        $this->pdo = $conexion->connect();
    }

    public function saveEmotion(int $user_id, string $fecha, string $emotion, string $comments)
    {
        // Ver si ya existe
        $stmt = $this->pdo->prepare("SELECT id FROM emotions WHERE user_id = :user_id AND fecha = :fecha");
        $stmt->bindValue(":user_id", (int)$user_id, PDO::PARAM_INT);
        $stmt->bindValue(":fecha", $fecha);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Hacer el update
            $row = $stmt->fetch();
            $stmtUpdate = $this->pdo->prepare("UPDATE emotions SET emotion = :emotion, comments = :comments WHERE id = :id");
            $stmtUpdate->bindValue(":emotion", $emotion);
            $stmtUpdate->bindValue(":comments", $comments);
            $stmtUpdate->bindValue(":id", $row['id']);
            $stmtUpdate->execute();
        } else {
            // Insertar un nuevo registro
            $stmtInsert = $this->pdo->prepare("INSERT INTO emotions (user_id, fecha, emotion, comments) VALUES (:user_id, :fecha, :emotion, :comments)");
            $stmtInsert->bindValue(":user_id", (int)$user_id, PDO::PARAM_INT);
            $stmtInsert->bindValue(":fecha", $fecha);
            $stmtInsert->bindValue(":emotion", $emotion);
            $stmtInsert->bindValue(":comments", $comments);
            $stmtInsert->execute();
        }
    }

    public function listEmotions(int $user_id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM emotions WHERE user_id = :user_id ORDER BY fecha ASC");
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $emotions = [];

        foreach ($rows as $row) {
            $emotions[] = new Emotion(
                $row['id'],
                $row['user_id'],
                $row['fecha'],
                $row['emotion'],
                $row['comments']
            );
        }

        return $emotions;
    }
}
