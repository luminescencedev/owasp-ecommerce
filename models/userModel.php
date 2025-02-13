<?php
require_once 'Database.php';
class User
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function getUsers()
    {
        $stmt = $this->pdo->query('SELECT * FROM users');
        return $stmt->fetchAll();
    }

    public function register($pseudo, $password, $firstname, $lastname, $email)
    {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        if (!preg_match('/^[a-zA-Z0-9_]+$/', $pseudo)) {
            return false;
        }

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM users WHERE pseudo = :pseudo OR email = :email');
        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->fetchColumn() > 0) {
            return false;
        }

        $role = 'Visiteur';
        if ($pseudo == 'admin') {
            $role = 'Admin';
        }

        $hashed_password = password_hash($password, PASSWORD_BCRYPT);


        $stmt = $this->pdo->prepare('INSERT INTO users (pseudo, password, firstname, lastname, email, role) 
                                     VALUES (:pseudo, :password, :firstname, :lastname, :email, :role)');

        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function login($pseudo, $password)
    {
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $pseudo)) {
            return false;
        }

        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE pseudo= :pseudo');
        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getUser($pseudo)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE pseudo = :pseudo');
        $stmt->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function deleteUser($id)
    {
        if (!filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])) {
            return false;
        }
        $stmt = $this->pdo->prepare('DELETE FROM users WHERE id_user = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

}