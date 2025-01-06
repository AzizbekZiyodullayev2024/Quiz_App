<?php

namespace App\Models;

use App\Traits\HasApiTokens;

class User extends DB{
    use HasApiTokens;
    public function getConn(): \PDO
    {
        return $this->conn;
    }
    public function createUser(string $fullName, string $email, string $password): bool
    {
        $query = "INSERT INTO users (full_name, email, password, created_at, updated_at) 
                  VALUES (:fullName, :email, :password, NOW(), NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
                ':fullName' => $fullName,
                ':email' => $email,
                ':password' => password_hash($password,  PASSWORD_DEFAULT),
        ]);
        $userId = $this->conn->lastInsertId();
        $this->createApiToken($userId);
        return true;
    }

    public function getUser(string $email,string $password): bool
    {
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt =  $this->conn->prepare($query);
        $stmt->execute([
            ':email' => $email,
        ]);
        $user = $stmt->fetch();
        if($user && password_verify($password, $user->password)){
            $this->createApiToken($user->id);
            return true;
        }else {
            return false;
        }
    }
}