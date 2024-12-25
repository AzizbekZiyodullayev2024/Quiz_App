<?php

//use App\Router;
//use Controllers\UserController;
//use Controllers\ToDoController;

use App\Models\User;

$user = new User();
dd($user->getConn());


//Router::get('/todos', [ToDoController::class, 'index']);
//Router::get('/users', [UserController::class, 'show']);
//Router::get('/',function (){
//    echo "Hello World!";
//});