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
            $resultUser = $result->getUserResult(Auth::user()->id, $quiz->id);
            if($resultUser) {
                $startedAt = strtotime($resultUser->started_at);
                $finishedAt = strtotime($resultUser->finished_at);

                $diffInSeconds = abs($finishedAt - $startedAt);

                $minutes = floor($diffInSeconds / 60);
                $seconds = $diffInSeconds % 60;

                $timeDiff = sprintf("%02d:%02d", $minutes, $seconds);

                apiResponse([
                    'errors' => [
                        'message' => 'You have already taken this quiz!'
                    ],
                    'data' => [
                        'result' => [
                            'id' => $resultUser->id,
                            'quiz_id' => $resultUser->quiz_id,
                            'started_at' => $resultUser->started_at,
                            'time_taken' => $timeDiff,
                        ]]
                ],404);
            }
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