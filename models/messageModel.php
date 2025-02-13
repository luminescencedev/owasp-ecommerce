<?php
require_once 'Database.php';

class MessageContact
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->connect();
    }

    public function sendMessage($email, $message)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $message = trim($message);
        if (strlen($message) < 5 || strlen($message) > 1000) {
            return false;
        }

        $stmt = $this->pdo->prepare('INSERT INTO MessageContact (email, message) VALUES (:email, :message)');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getMessageById($id_message)
    {
        if (!filter_var($id_message, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])) {
            return false;
        }

        $stmt = $this->pdo->prepare('SELECT * FROM MessageContact WHERE id_message = :id_message');
        $stmt->bindParam(':id_message', $id_message, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch();
    }

    public function getAllMessages()
    {
        $stmt = $this->pdo->query('SELECT * FROM MessageContact ORDER BY date_envoi DESC');
        return $stmt->fetchAll();
    }
}
?>
