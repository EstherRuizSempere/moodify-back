<?php

include_once __DIR__ . '/../../utilities/UserUtils.php';
include_once __DIR__ . '/../../entities/User.php';
include_once __DIR__ . '/../../manager/UserManager.php';

class LoginController {
    public function __invoke(string $email, string $password)
    {
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);

        if ($user == null) {
            throw new Exception("Usuario o contraseña incorrectos");
        }

        if(!UserUtils::verifyPassword($password, $user->getPassword()))
        {
            throw new Exception("Usuario o contraseña incorrectos");
        }

        return $user;
    }
}