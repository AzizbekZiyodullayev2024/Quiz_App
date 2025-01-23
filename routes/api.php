<?php

use App\Http\Controllers\API\QuizController;
use App\Http\Controllers\API\UserController;
use \App\Http\Controllers\API\ResultController;
use Src\Router;

Router::get('/api/users/getInfo',[UserController::class,'show'],'auth:api');
// Auth;
Router::post("/api/register", [UserController::class, "storeUser"]);
Router::post("/api/login", [UserController::class, "login"]);
// Quiz;
Router::post("/api/quizzes",[QuizController::class,"store"],'auth:api');
Router::get("/api/quizzes",[QuizController::class,"index"],'auth:api');
Router::delete("/api/quizzes/{id}",[QuizController::class,"destroy"],'auth:api');

Router::put("/api/quizzes/{id}",[QuizController::class,"update"],'auth:api');
Router::get("/api/quizzes/{id}",[QuizController::class,"show"],'auth:api');

//Result
Router::post("/api/results",[ResultController::class,"store"],'auth:api');

//NotFound;
Router::notFound();