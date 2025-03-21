<?php

require_once __DIR__."/Database/Database.php";

use PDO;

class UserModel{

    private $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();

    }

    public function createUser($username, $email, $password){
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":name"-> $username,
            ":email"-> $email,
            ":password"-> $hashPassword,
        ]);
    }

    public function getUserByEmail($email){
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':email'=>$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers(){
        $sql = "SELECT id, name, email FROM users";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
