<?php

namespace App\Models;

use App\Models\DB;

class Quiz extends DB{
    public function create(int $userId,string $title,string $description,int $timeLimit): bool{
        $query = "INSERT INTO quizzes (userId,title, description,time_limit,created_at,updated_at) 
                   VALUES(:userId,:title,:description,:timeLimit,NOW(),NOW())";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            'userId' => $userId,
            'title' => $title,
            'description' => $description,
            'timeLimit' => $timeLimit,
        ]);
    }
}