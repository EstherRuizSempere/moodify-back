<?php

use utilities\CorsUtility;
use utilities\CheckMethodUtility;

include_once __DIR__ . '/../../utilities/CorsUtility.php';
include_once __DIR__ . '/../../controllers/emotion/EmotionStatsController.php';
include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';

CorsUtility::applyCors();
CheckMethodUtility::checkGet();

$userId = $_GET['user_id'] ?? null;

if (!$userId) {
    echo json_encode(['status' => 'error', 'message' => 'user_id is required']);
    exit;
}

try {
    $stats = EmotionStatsController::getUserEmotionStats($userId);
    echo json_encode(['status' => 'success', 'data' => $stats]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}