<?php

use utilities\CheckMethodUtility;
use utilities\CorsUtility;

include_once __DIR__ . '/../../utilities/CorsUtility.php';
include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';
include_once __DIR__ . '/../../controllers/user/DeleteUserController.php';

CorsUtility::applyCors();
CheckMethodUtility::checkPost();

$user_id = $_POST['user_id'] ?? '';

$controller = new DeleteUserController();

try {
    $controller->__invoke($user_id);

    $response = [
        'status' => 'success',
        'message' => 'Cuenta eliminada correctamente'
    ];
} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);
