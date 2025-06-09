<?php

include_once __DIR__ . '/../../manager/UserManager.php';
include_once __DIR__ . '/../../utilities/UserUtils.php';

class ResetPasswordController
{
    public function __invoke(string $email, string $newPassword): array
    {
        // Validamos el correo electrónico
        if (!UserUtils::validateEmail($email)) {
            throw new Exception("El correo electrónico no es válido ❌");
        }

        // Validamos que la nueva contraseña no esté vacía
        if (empty($newPassword)) {
            throw new Exception("La nueva contraseña no puede estar vacía ❌");
        }

        // Hacemos la búsqueda del usuario
        $userManager = new UserManager();
        $user = $userManager->getUserByEmail($email);

        if (!$user) {
            throw new Exception("No se encontró un usuario con ese correo.");
        }

        // Hasheamos y actualizamos la contraseña
        $hashedPassword = UserUtils::hashPassword($newPassword);
        $userManager->updatePasswordByEmail($email, $hashedPassword);

        // Devolvemos respuesta de éxito
        return [
            'status' => 'success',
            'message' => 'Contraseña actualizada correctamente ✅'
        ];
    }
}
