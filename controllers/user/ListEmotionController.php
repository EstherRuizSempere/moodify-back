<?php
include_once __DIR__ . '/../../manager/EmotionManager.php';

class ListEmotionController
{
    public function __invoke(int $user_id): array
    {
        $emotionManager = new EmotionManager();
        $emotions = $emotionManager->listEmotions($user_id);

        //Transformo a array para devolver como JSON
        $emotionsArray = [];
        foreach ($emotions as $emotion) {
            $emotionsArray[] = $emotion->toArray();
        }

        return $emotionsArray;
    }
}
