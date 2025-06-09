<?php

include_once __DIR__ . '/../../manager/UserManager.php';

class DeleteUserController {
    public function __invoke($user_id)
    {
        $userManager = new UserManager();
        $userManager->deleteUserById($user_id);
    }
}
