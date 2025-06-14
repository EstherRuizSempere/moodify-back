<?php
include_once __DIR__ . '/../../manager/FavoriteManager.php';

class FavoriteController
{
    public static function addFavorite(int $userId, string $trackId): void
    {
        $manager = new FavoriteManager();
        $manager->addFavorite($userId, $trackId);
    }

    public static function removeFavorite(int $userId, string $trackId): void
    {
        $manager = new FavoriteManager();
        $manager->removeFavorite($userId, $trackId);
    }

    public static function listFavorites(int $userId): array
    {
        $manager = new FavoriteManager();
        return $manager->listFavorites($userId);
    }
}