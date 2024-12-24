<?php

use App\Router;
use Controllers\UserController;
use Controllers\ToDoController;

Router::get('/todos', [ToDoController::class, 'show']);
Router::get('/users', [ToDoController::class, 'index']);