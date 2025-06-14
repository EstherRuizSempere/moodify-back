<?php
include_once __DIR__ . '/../../manager/EmotionManager.php';

class EmotionStatsController
{
    public static function getUserEmotionStats($userId)
    {
        $emotionManager = new EmotionManager();
        return $emotionManager->getEmotionStatsByUser($userId);
    }
}
