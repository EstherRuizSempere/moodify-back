<?php

include_once __DIR__ . '/../constants/DataBase.php';

class ConnectionDB
{
    public function connect()
    {
        try {
            $pdo = new PDO("mysql:host=" . DataBase::$host . ";dbname=" . DataBase::$db, DataBase::$user, DataBase::$password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $error) {
            throw new Exception("Error de conexión a la base de datos: " . $error->getMessage());
        }
    }
}