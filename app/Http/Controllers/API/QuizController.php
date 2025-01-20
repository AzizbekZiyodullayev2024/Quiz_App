<?php

namespace App\Http\Controllers\API;

use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Traits\Validator;
use Src\Auth;

class QuizController
{
    use Validator;
    public function take_quiz(): void{
        view('/quiz/take_quiz');
    }

    public function create_quiz(): void{
        view('/dashboard/create_quiz');
    }

    public function store(): void
    {
        $quizItems = $this->validate([
            'title' => 'string',
            'description' => 'string',
            'timeLimit' => 'integer',
            'questions' => 'array',
        ]);
        $quizTitle = $quizItems['title'];
        $quizDescription = $quizItems['description'];
        $timeLimit = $quizItems['timeLimit'];
        $questions = $quizItems['questions'];

        $quiz = new Quiz();
        $question = new Question();
        $option = new Option();

        $quiz_id = $quiz->create(Auth::user()->id, $quizTitle,
            $quizDescription,
            $timeLimit);
        foreach ($questions as $questionItem) {
            $question_id = $question->create($quiz_id, $questionItem['quiz']);
            $correct = $questionItem['correct'];
            foreach ($questionItem['options'] as $key => $optionItem) {
                $option->create($question_id, $optionItem, $correct == $key);
            }
        }
    }
}
