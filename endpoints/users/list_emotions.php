<?php

use utilities\CorsUtility;
use utilities\CheckMethodUtility;

include_once __DIR__ . '/../../controllers/user/ListEmotionController.php';
include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';
include_once __DIR__ . '/../../utilities/CorsUtility.php';

CorsUtility::applyCors();
header('Content-Type: application/json; charset=utf-8');

CheckMethodUtility::checkPost();

// Validar user_id
$user_id = $_POST["user_id"] ?? '';

if (empty($user_id)) {
    echo json_encode([
        "status" => "error",
        "message" => "El campo user_id es obligatorio",
        "data" => []
    ]);
    exit();
}

$listEmotionController = new ListEmotionController();

try {
    $emotions = $listEmotionController->__invoke($user_id);

    $response = [
        "status" => "success",
        "message" => "Emociones listadas correctamente",
        "data" => $emotions
    ];
} catch (Exception $error) {
    $response = [
        "status" => "error",
        "message" => $error->getMessage(),
        "data" => []
    ];
}

echo json_encode($response);
