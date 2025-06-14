<?php
include_once __DIR__ . '/../config/ConnectionDB.php';
include_once __DIR__ . '/../entities/User.php';

class UserManager
{
    private $pdo;

    public function __construct()
    {
        $conexion = new ConnectionDB();
        $this->pdo = $conexion->connect();
    }

    public function register(User $user)
    {
        $sql = "INSERT INTO users (name, email, password) 
        VALUES ( :name, :email, :password)";

        try {
            //Validaciones
            if (!UserUtils::validateName($user->getName())) {
                throw new Exception("El nombre no es válido ❌");
            }
            if (!UserUtils::validateEmail($user->getEmail())) {
                throw new Exception("El email no es válido ❌");
            }
            if ($this->emailExists($user->getEmail())) {
                throw new Exception("El email ya está registrado 🚫");
            }


            //Haseo contraseña antes de almacenarla
            $passwordHash = UserUtils::hashPassword($user->getPassword());

            //Preparo la consulta
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":name", $user->getName());
            $statement->bindValue(":email", $user->getEmail());
            $statement->bindValue(":password", $passwordHash);
            $statement->execute();
            return $statement;

        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }

    }

    public function emailExists(string $email): bool
    {
        $sql = "SELECT COUNT(*) FROM users WHERE LOWER(email) = LOWER(:email)";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":email", $email);
            $statement->execute();
            $count = $statement->fetchColumn();

            return $count > 0;

        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }


    public function updateUser(User $user, bool $updatePassword = false)
    {
        if ($updatePassword) {
            $sql = "UPDATE users SET name = :name, email = :email, password = :password WHERE id = :id";
        } else {
            $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        }

        try {
            // Validaciones
            if (!UserUtils::validateName($user->getName())) {
                throw new Exception("El nombre no es válido ❌");
            }
            if (!UserUtils::validateEmail($user->getEmail())) {
                throw new Exception("El email no es válido ❌");
            }

            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":id", $user->getId());
            $statement->bindValue(":name", $user->getName());
            $statement->bindValue(":email", $user->getEmail());

            if ($updatePassword) {
                // Haseo la contraseña antes de almacenarla
                $passwordHash = UserUtils::hashPassword($user->getPassword());
                $statement->bindValue(":password", $passwordHash);
            }

            $statement->execute();
            return $statement;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }


    public function deleteUserById(int $id)
    {
        $sql = "DELETE FROM users WHERE id = :id";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":id", $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }


    public function getUserById(int $id): User
    {
        $sql = "SELECT * FROM users WHERE id = :id";

        try {
            //Preparo la consulta
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":id", $id);
            $statement->execute();
            $userData = $statement->fetch(PDO::FETCH_ASSOC);

            if ($userData == null) {
                throw new Exception("Usuario no encontrado");
            }

            return new User($userData["id"], $userData["name"], $userData["email"], $userData["password"]);

        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function getUserByEmail(string $email): User
    {
        $sql = "SELECT * FROM users WHERE LOWER(email) = LOWER(:email)";

        try {
            //Preparo la consulta
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":email", $email);
            $statement->execute();
            $userData = $statement->fetch(PDO::FETCH_ASSOC);

            if ($userData == null) {
                throw new Exception("Usuario no encontrado");
            }

            return new User($userData["id"], $userData["name"], $userData["email"], $userData["password"]);

        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function updatePasswordByEmail(string $email, string $hashedPassword)
    {
        $sql = "UPDATE users SET password = :password WHERE LOWER(email) = LOWER(:email)";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $hashedPassword);
            $statement->execute();

            return;
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }


}