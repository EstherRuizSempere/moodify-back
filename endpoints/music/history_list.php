<?php
use utilities\CorsUtility;
use utilities\CheckMethodUtility;

include_once __DIR__ . '/../../utilities/CorsUtility.php';
include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';
include_once __DIR__ . '/../../controllers/music/HistoryController.php';

CorsUtility::applyCors();
CheckMethodUtility::checkGet();

$userId = $_GET['user_id'] ?? null;
$limit = $_GET['limit'] ?? 10;

if (!$userId) {
    echo json_encode(['status' => 'error', 'message' => 'Necesita el user_id']);
    exit;
}

try {
    $history = HistoryController::listHistory($userId, $limit);
    echo json_encode(['status' => 'success', 'data' => $history]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}