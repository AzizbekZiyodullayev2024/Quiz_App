<?php

namespace App\Models;

use App\Models\DB;

class Quiz extends DB{

    public function delete($quizId): bool{
        $query = "DELETE FROM quizzes WHERE id = :quizId";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            "quizId" => $quizId]
        );
    }
    public function getUserById(int $userId): bool|array{
        $query = "SELECT * FROM quizzes WHERE user_id = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            "userId" => $userId
        ]);
        return $stmt->fetchAll();
    }

    public function create(int $userId,string $title,string $description,int $timeLimit): int{
        $query = "INSERT INTO quizzes (user_id,title, description,time_limit,created_at,updated_at) 
                   VALUES(:user_id,:title,:description,:time_limit,NOW(),NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            'user_id' => $userId,
            'title' => $title,
            'description' => $description,
            'time_limit' => $timeLimit,
        ]);
        return $this->conn->lastInsertId();
    }
}