<?php

use utilities\CheckMethodUtility;

include_once __DIR__ . '/../../controllers/user/RegisterController.php';

include_once __DIR__ . '/../../utilities/CheckMethodUtility.php';


CheckMethodUtility::checkPost();

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];

//Llamo al controlador
$registerController = new RegisterController();
//Ahora controlo los errores porque vamos a devovler un formato estandar a la app de angular
try {
    $registerController->__invoke($name, $email, $password);
    //Devuelvo algo a la aplicación de angular (JSON)
    $response = [
        "status" => "success",
        "message" => "Usuario registrado correctamente",
//        Data siempre va a tener formato array
        "data" => []

    ];

} catch (Exception $error) {
    //Devuelvo algo a la aplicación de angular (JSON)
    $response = [
        "status" => "error",
        "message" => $error->getMessage(),
        "data" => []
    ];
}

//Devuelvo la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
