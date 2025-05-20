<?php
include_once __DIR__ . '/../config/ConnectionDB.php';

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
        $sql = "SELECT * FROM users WHERE email = :email";

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
}