<?php

use Src\Router;
use App\Http\Controllers\WEB\HomeController;
use App\Http\Controllers\WEB\UserController;
use \App\Http\Controllers\API\QuizController;

Router::get('/',[HomeController::class,'home']);
Router::get('/about',[HomeController::class,'about']);
Router::get('/login',[HomeController::class,'login']);
Router::get('/register',[HomeController::class,'register']);

Router::get('/dashboard',[UserController::class,'home']);
Router::get('/dashboard/quizzes',[HomeController::class,'quizzes']);
Router::get('/dashboard/statistics',[HomeController::class,'statistics']);
Router::get('/dashboard/create_quiz',[HomeController::class,'create_quiz']);

Router::get('/dashboard/create_quizzes',[QuizController::class,'create_quiz']);
Router::get('/quiz/take_quiz',[QuizController::class,'take_quiz']);

Router::notFound();