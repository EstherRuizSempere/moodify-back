<?php
use utilities\CorsUtility;

include_once __DIR__ . '/../../utilities/CorsUtility.php';

CorsUtility::applyCors();

header('Content-Type: application/json');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (session_status() === PHP_SESSION_ACTIVE) {
    session_unset();
    session_destroy();
}

echo json_encode([
    'status' => 'success',
    'message' => 'Sesión cerrada correctamente'
]);
