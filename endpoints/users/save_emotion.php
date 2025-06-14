<?php
use utilities\CorsUtility;
use utilities\CheckMethodUtility;

include_once __DIR__ . '/../../utilities/CorsUtility.php';
include_once __DIR__ . '/../../controllers/user/SaveEmotionController.php';
include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';

CorsUtility::applyCors();
CheckMethodUtility::checkPost();

$user_id = $_POST["user_id"];
$fecha = $_POST["fecha"];
$emotion = $_POST["emotion"];
$comments = $_POST["comments"];

$saveEmotionController = new SaveEmotionController();

try {
    $saveEmotionController->__invoke($user_id, $fecha, $emotion, $comments);

    $response = [
        "status" => "success",
        "message" => "Emoción guardada correctamente",
        "data" => []
    ];
} catch (Exception $error) {
    $response = [
        "status" => "error",
        "message" => $error->getMessage(),
        "data" => []
    ];
}

echo json_encode($response);
