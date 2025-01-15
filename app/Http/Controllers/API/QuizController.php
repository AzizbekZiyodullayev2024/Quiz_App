<?php

namespace App\Http\Controllers\API;
use App\Models\Question;
use App\Models\Quiz;
use App\Traits\Validator;
use Src\Auth;
class QuizController{
    use Validator;
    public function store(): void{
        $quizItems = $this->validate([
            'title'=>'string',
            'description'=>'string',
            'timeLimit'=>'integer',
            'questions'=>'array',
        ]);
        $quizTitle = $quizItems['title'];
        $quizDescription = $quizItems['description'];
        $timeLimit = $quizItems['timeLimit'];
        $questions = $quizItems['questions'];

        $quiz = new Quiz();
        $question = new Question();
        $quiz_id = $quiz->create(Auth::user()->id, $quizItems['title'], $quizItems['description'], $quizItems['timeLimit']);
        apiResponse(['message' => 'Quiz created successfully.'], 201);
    }
}