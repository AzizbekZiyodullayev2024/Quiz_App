<?php

use App\Http\Controllers\API\QuizController;
use App\Http\Controllers\API\UserController;
use Src\Router;

Router::get('/api/users/{id}',[UserController::class,'show'],'auth:api');

// Auth;
Router::post("/api/register", [UserController::class, "storeUser"]);
Router::post("/api/login", [UserController::class, "login"]);
//
// Quiz;
Router::post("/api/quizzes",[QuizController::class,"store"]);

//NotFound;
Router::notFound();
