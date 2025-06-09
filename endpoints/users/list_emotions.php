<?php


use utilities\CheckMethodUtility;

include_once __DIR__ . '/../../controllers/user/ListEmotionController.php';
include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';

header('Content-Type: application/json; charset=utf-8');

CheckMethodUtility::checkPost();

$user_id = $_POST["user_id"];

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
