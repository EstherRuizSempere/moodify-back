<?php
use utilities\CorsUtility;
use utilities\CheckMethodUtility;

include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';
include_once __DIR__ . '/../../controllers/user/UpdateProfileController.php';
include_once __DIR__ . '/../../utilities/CorsUtility.php';

CorsUtility::applyCors();
CheckMethodUtility::checkPost();

$id = $_POST['user_id'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$controller = new UpdateProfileController();

try {
    $user = $controller->__invoke($id, $name, $email, $password);

    $response = [
        'status' => 'success',
        'message' => 'Perfil actualizado correctamente',
        'data' => $user->toArray()
    ];
} catch (Exception $e) {
    $response = [
        'status' => 'error',
        'message' => $e->getMessage(),
        'data' => []
    ];
}

echo json_encode($response);
