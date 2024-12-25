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
                  VALUES (:fullName, :email, :password, NOW(), NOW()";
        return $this->conn
            ->prepare($query)
            ->execute([
                ':full_name' => $fullName,
                ':email' => $email,
                ':password' => password_hash($password,  PASSWORD_DEFAULT),
        ]);
    }

    public function getUser(string $email,string $password): bool
    {
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $stmt =  $this->conn->prepare($query);
        $stmt->execute([
            ':email' => $email,
            ':password' => $password,
        ]);
        $user = $stmt->fetch();
        if($user && password_verify($password, $user->password)){
            return true;
        }
        return false;
    }
}