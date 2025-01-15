<?php

namespace App\Models;

use App\Models\DB;

class Option extends DB{
    public function create(int $questionId,string $questionText, bool $isCorrect): bool{
        $query = "INSERT INTO options (question_id,option_text,is_correct, updated_at,created_at) 
                   VALUES(:questionId,:questionText, :isCorrect,NOW(),NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':questionId' => $questionId,
            ':option_text' => $questionText,
            ':isCorrect' => $isCorrect,
        ]);
        return $this->conn->lastInsertId();
    }
}