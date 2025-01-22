<?php

namespace App\Models;

use App\Models\DB;
use PDO;

class Question extends DB{
    public function create(int $quizId,string $questionText){
        $query = "INSERT INTO questions (quiz_id, question_text, updated_at,created_at) 
                   VALUES(:quiz_id,:question_text,NOW(),NOW())";
        $stmt = $this->conn->prepare($query)->execute([
            ':quiz_id' => $quizId,
            ':question_text' => $questionText,
        ]);
        return $this->conn->lastInsertId();
    }

    public function deleteQuestionById(int $questionId){
        $query = "DELETE FROM questions WHERE quiz_id = :questionId";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':questionId' => $questionId]);
    }
    public function getWithOptions(int $quizId){

        $question = "SELECT * FROM questions WHERE quiz_id = :quiz_id";
        $stmt = $this->conn->prepare($question);
        $stmt->execute([
            'quiz_id' => $quizId]
        );
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $questionIds = array_column($questions,'id');
        $placeholders = rtrim(str_repeat('?,',count($questionIds)),',');
        $query = "SELECT * FROM options WHERE question_id IN ($placeholders)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($questionIds);
        $options = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $groupedOptions = [];

        foreach ($options as $option){
            $groupedOptions[$option['question_id']][] = $option;
        }
        foreach ($questions as &$question){
            $question['options'] = $groupedOptions[$question['id']] ?? [];
        }
        return $questions;
    }
}
