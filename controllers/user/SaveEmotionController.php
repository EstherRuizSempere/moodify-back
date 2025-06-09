<?php
include_once __DIR__ . '/../../manager/EmotionManager.php';

class SaveEmotionController
{
    public function __invoke(int $user_id, string $fecha, string $emotion, string $comments)
    {
        $emotionManager = new EmotionManager();
        $emotionManager->saveEmotion($user_id, $fecha, $emotion, $comments);
    }
}
