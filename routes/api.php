<?php

use App\Http\Controllers\API\QuizController;
use App\Http\Controllers\API\UserController;
use src\Router;

// Auth
Router::post("/api/register", [UserController::class, "store"]);
Router::post("/api/login", [UserController::class, "login"]);

// Quiz
Router::post("/api/quizzes",[QuizController::class,"store"]);