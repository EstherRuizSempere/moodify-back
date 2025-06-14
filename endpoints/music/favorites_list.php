<?php

use utilities\CheckMethodUtility;
use utilities\CorsUtility;

include_once __DIR__ . '/../../utilities/CorsUtility.php';
include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';
include_once __DIR__ . '/../../controllers/music/FavoriteController.php';

CorsUtility::applyCors();
CheckMethodUtility::checkGet();

$userId = $_GET['user_id'] ?? null;

if (!$userId) {
    echo json_encode(['status' => 'error', 'message' => 'Necesita el user_id']);
    exit;
}

try {
    $favorites = FavoriteController::listFavorites($userId);
    echo json_encode(['status' => 'success', 'data' => $favorites]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}