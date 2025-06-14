<?php
include_once __DIR__ . '/../../utilities/UserUtils.php';
include_once __DIR__ . '/../../entities/User.php';
include_once __DIR__ . '/../../manager/UserManager.php';
include_once __DIR__ . '/../../utilities/MailUtility.php';

class RegisterController
{
    public function __invoke(string $name, string $email, string $password)
    {
        UserUtils::validateName($name);
        UserUtils::validateEmail($email);
        UserUtils::validatePassword($password);

        $user = new User(0, $name, $email, $password);

        //Creo el usuario
        $userManager = new UserManager();
        $userManager->register($user);

        \utilities\MailUtility::sendWelcomeEmail($email, $name);

    }
}