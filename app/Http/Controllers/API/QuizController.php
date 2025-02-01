<?php

namespace App\Http\Controllers\API;
use App\Models\DB;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use App\Traits\Validator;
use Src\Auth;

class QuizController{
    use Validator;
    public function index(){
        $quizzes = (new Quiz())->getUserById(Auth::user()->id);
        apiResponse(['quizzes' => $quizzes]);
    }
    public function destroy (int $quizId): void{
        $quiz = new Quiz();
        $quiz->delete($quizId);
        apiResponse([
            'message' => 'Quiz deleted successfully']);
    }
    public function show (int $quizId): void {
        $quiz = ((new Quiz())->find($quizId));
        if($quiz) {
            $questions = (new Question())->getWithOptions($quizId);
            $quiz->questions = $questions;
            $questionCount = $questions['questions'];
            apiResponse([
                'quiz' => $quiz,
                'questionCount' => $questionCount
            ]);
        }
        apiResponse(['errors' => ['message' => 'Quiz not found']],404);
    }
    public function showByUniqueValue (string $uniqueValue): void
    {
        $quiz = ((new Quiz())->findByUniqueValue($uniqueValue));
        if ($quiz) {
            $questions = (new Question())->getWithOptions($quiz->id);
            $quiz->questions = $questions;
            apiResponse($quiz);
        }
        apiResponse(['errors' => ['message' => 'Quiz not found']], 404);
    }
    public function create_quiz(): void{
        view('/dashboard/create_quiz');
    }
    public function update(int $quizId){
        $quizItems = $this->validate([
            'title' => 'string',
            'description' => 'string',
            'timeLimit' => 'integer',
            'questions' => 'array',
        ]);
        $quiz = new Quiz();
        $question = new Question();
        $option = new Option();
        $quiz->update($quizId,
            $quizItems['title'],
            $quizItems['description'],
            $quizItems['timeLimit']
        );
        $question->deleteQuestionById($quizId);
        $questions = $quizItems['questions'];

        foreach ($questions as $questionItem) {
            $question_id = $question->create($quizId, $questionItem['quiz']);
            $correct = $questionItem['correct'];
            foreach ($questionItem['options'] as $key => $optionItem) {
                $option->create($question_id, $optionItem, $correct == $key);
            }
        }
        apiResponse(['message' => 'Quiz updated successfully']);
    }
    public function store(): void{
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
        apiResponse(['message'=>"created quiz successfully"],201);
    }
}
