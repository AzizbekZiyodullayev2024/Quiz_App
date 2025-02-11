<?php

namespace App\Models;

use App\Models\DB;

class Option extends DB {
    public function create(int $questionId,string $optionText, bool $isCorrect): int{
        $query = "INSERT INTO options (question_id,option_text,  is_correct, updated_at, created_at) 
                   VALUES(:question_id, :option_text, :is_correct,NOW(),NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':option_text' => $optionText,
            ':question_id' => $questionId,
            ':is_correct' => $isCorrect ? 1 : 0,
        ]);
        return $this->conn->lastInsertId();
    }
}