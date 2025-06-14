<?php
include_once __DIR__ . '/../../manager/HistoryManager.php';

class HistoryController
{
    public static function addHistory($userId, $trackId)
    {
        $manager = new HistoryManager();
        $manager->addHistory($userId, $trackId);
    }

    public static function listHistory($userId, $limit = 10)
    {
        $manager = new HistoryManager();
        return $manager->listHistory($userId, $limit);
    }
}