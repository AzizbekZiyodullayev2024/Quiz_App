<?php

namespace App\Http\Controllers\API;

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
        dd($quiz);
        if($quiz) {
            $result = new Result();
            $result->create(
                Auth::user()->id,
                $quiz->id,
                $quiz->time_limit);
        }
    }
}