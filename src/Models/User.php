<?php
namespace App\Models;
use PDO;
class User extends DB{
    public function getConn(): \PDO
    {
        return $this->conn;
    }
    public function createUser(string $fullName, string $email, string $password): bool
    {
        $query = "INSERT INTO users (full_name, email, password, created_at, updated_at) 
                  VALUES (:full_name, :email, :password, NOW(), NOW()";
        return $this->conn
            ->prepare($query)
            ->execute([
                ':fullName' => $fullName,
                ':email' => $email,
                ':password' => password_hash($password,  PASSWORD_DEFAULT),
        ]);
    }
}