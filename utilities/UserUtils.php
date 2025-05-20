<?php

class UserUtils
{
    //Hasheo de contraseña para la base de datos

    public static function hashPassword($password)
    {
        return hash("sha512", $password);
    }

    //TODO Hacer función para hacer la doble verificación de la contraseña

    //Requisitos para crear la contraseña
    public static function passwordDigits($password)
    {
        return strlen($password >= 4);
    }

    public static function validateName($name)
    {
        if (preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', $name)) {
            return true;
        } else {

            throw new Exception("El nombre no es válido 😕");

        }
    }

    public static function validateEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            throw new Exception("El email no es válido 😔");
        }
    }

    public static function verifyPassword($password, $hash)
    {
        return $hash === self::hashPassword($password);
    }
}