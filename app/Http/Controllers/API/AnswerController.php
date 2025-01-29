<?php

namespace App\Http\Controllers\API;

use App\Models\Answer;
use App\Models\DB;
use App\Traits\Validator;

class AnswerController extends DB{
    use Validator;
    public function store(){
        $answerItems = $this->validate([
            'result_id' => 'integer',
            'option_id' => 'integer',
        ]);
        $answer = new Answer();
        $answerData = $answer->create(
            $answerItems['result_id'],
            $answerItems['option_id'],
        );
        apiResponse([
                 'message' => 'Answer created successfully',
                 'data' => $answerData
        ]);

    }
}