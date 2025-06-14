<?php

class UserUtils
{
    //Hasheo de contraseña para la base de datos

    public static function hashPassword($password)
    {
        return hash("sha512", $password);
    }



    //Requisitos para crear la contraseña
    public static function validatePassword($password)
    {
        // Mínimo 8 caracteres
        if (strlen($password) < 8) {
            throw new Exception("La contraseña debe tener al menos 8 caracteres 🛡️");
        }

        // Al menos un número
        if (!preg_match('/[0-9]/', $password)) {
            throw new Exception("La contraseña debe incluir al menos un número 🔢");
        }

        // Al menos una letra minúscula
        if (!preg_match('/[a-z]/', $password)) {
            throw new Exception("La contraseña debe incluir al menos una letra minúscula 🔠");
        }

        // Al menos una letra mayúscula
        if (!preg_match('/[A-Z]/', $password)) {
            throw new Exception("La contraseña debe incluir al menos una letra mayúscula 🔡");
        }

        return true;
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