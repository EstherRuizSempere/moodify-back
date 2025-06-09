<?php

use utilities\CheckMethodUtility;

include_once __DIR__ . '/../../controllers/user/LoginController.php';

include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';


CheckMethodUtility::checkPost();

$password = $_POST["password"];
$email = $_POST["email"];

$loginController = new LoginController();

try {
    $user = $loginController->__invoke($email, $password);
    $response = [
        "status" => "success",
        "message" => "Usuario logueado correctamente",
        "data" => $user->toArray()
    ];

} catch (Exception $error) {
    $response = [
        "status" => "error",
        "message" => $error->getMessage(),
        "data" => []
    ];
}

echo json_encode($response);