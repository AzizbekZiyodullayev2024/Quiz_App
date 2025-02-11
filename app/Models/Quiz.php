<?php

namespace App\Models;
use App\Models\DB;
class Quiz extends DB{
    public function find(int $quizId){
        $query = "SELECT * FROM quizzes WHERE id = :quizId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':quizId' => $quizId]);
        return $stmt->fetch();
    }
    public function findByUniqueValue(string $uniqueValue){
        $query = "SELECT * FROM quizzes WHERE unique_value = :uniqueValue";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':uniqueValue' => $uniqueValue]);
        return $stmt->fetch();
    }
    public function delete($quizId): bool{
        $query = "DELETE FROM quizzes WHERE id = :quizId";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ":quizId" => $quizId
            ]);
    }
    public function getUserById(int $userId): bool|array {
        $query = "SELECT * FROM quizzes WHERE user_id = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            "userId" => $userId
        ]);
        return $stmt->fetchAll();
    }

    public function create(int $userId,string $title,string $description,int $timeLimit): int{
        $query = "INSERT INTO quizzes (unique_value,user_id,title, description,time_limit,created_at,updated_at) 
                   VALUES(:uniqueValue,:user_id,:title,:description,:time_limit,NOW(),NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':uniqueValue' => uniqid(),
            ':user_id' => $userId,
            ':title' => $title,
            ':description' => $description,
            ':time_limit' => $timeLimit,
        ]);
        return $this->conn->lastInsertId();
    }

    public function update(int $quizId, mixed $title, mixed $description, mixed $timeLimit)
    {
        $query = "UPDATE quizzes SET title = :title, description = :description, time_limit = :timeLimit WHERE id = :quizId";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ":title" => $title,
            ":description" => $description,
            ":timeLimit" => $timeLimit,
            ":quizId" => $quizId
        ]);
    }
}