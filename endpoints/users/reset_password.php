<?php

use utilities\CheckMethodUtility;
use utilities\CorsUtility;

include_once __DIR__ . '/../../utilities/CorsUtility.php';
include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';
include_once __DIR__ . '/../../controllers/user/ResetPasswordController.php';

CorsUtility::applyCors();
CheckMethodUtility::checkPost();

$email = $_POST['email'] ?? '';
$newPassword = $_POST['new_password'] ?? '';

$controller = new ResetPasswordController();

try {
    $response = $controller->__invoke($email, $newPassword);

} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => $e->getMessage()
    ];
}

echo json_encode($response);