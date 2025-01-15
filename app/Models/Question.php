<?php

namespace App\Models;

use App\Models\DB;

class Question extends DB{
    public function create(int $quizId,string $questionText): bool{
        $query = "INSERT INTO questions (quiz_id,question_text, updated_at,created_at) 
                   VALUES(:quizId,:questionText,NOW(),NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':quizId' => $quizId,
            ':question_text' => $questionText,
        ]);
        return $this->conn->lastInsertId();
    }
}