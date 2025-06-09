<?php

include_once __DIR__ . '/../../manager/UserManager.php';
include_once __DIR__ . '/../../entities/User.php';
include_once __DIR__ . '/../../utilities/UserUtils.php';

class UpdateProfileController {
    public function __invoke($id, $name, $email, $password)
    {
        $userManager = new UserManager();
        $user = $userManager->getUserById($id);

        if (!$user) {
            throw new Exception("Usuario no encontrado.");
        }

        $user->setName($name);
        $user->setEmail($email);

        $updatePassword = false;

        if (!empty($password)) {
            $user->setPassword($password);
            $updatePassword = true;
        }

        $userManager->updateUser($user, $updatePassword);

        return $user;
    }
}
