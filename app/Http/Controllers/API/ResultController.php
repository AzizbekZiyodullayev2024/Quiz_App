<?php

namespace App\Http\Controllers\API;

use App\Models\Question;
use App\Models\Result;
use App\Models\Quiz;
use App\Traits\Validator;
use Src\Auth;

class ResultController{
    use Validator;
    public function store(){
        $resultItems = $this->validate([
            'quiz_id' => 'required|integer',
        ]);
        $quiz = (new Quiz())->find($resultItems['quiz_id']);
        if($quiz){
            $result = new Result();
            $resultData = $result->create(
                Auth::user()->id,
                $quiz->id,
                $quiz->time_limit);
            apiResponse([
                'message' => 'Result stored successfully',
                'result' => $resultData
            ]);
        }
        apiResponse(['errors' => [
            'message' => 'Quiz not found'
        ]]);
    }
}