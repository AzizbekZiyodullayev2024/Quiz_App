<?php

use App\Router;
use Controllers\UserController;
use Controllers\ToDoController;

Router::get('/todos', [ToDoController::class, 'index']);
Router::get('/users', [UserController::class, 'show']);
Router::get('/',function (){
    echo "Hello World!";
});