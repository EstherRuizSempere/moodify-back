<?php
use utilities\CorsUtility;
use utilities\CheckMethodUtility;

include_once __DIR__ . '/../../utilities/CorsUtility.php';
include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';
include_once __DIR__ . '/../../controllers/music/HistoryController.php';

CorsUtility::applyCors();
CheckMethodUtility::checkPost();

$userId = $_POST['user_id'] ?? null;
$trackId = $_POST['track_id'] ?? null;

if (!$userId || !$trackId) {
    echo json_encode(['status' => 'error', 'message' => 'Necesita el user_id y el track_id']);
    exit;
}

try {
    HistoryController::addHistory($userId, $trackId);
    echo json_encode(['status' => 'success', 'message' => 'Historial añadido correctamente ✅']);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}