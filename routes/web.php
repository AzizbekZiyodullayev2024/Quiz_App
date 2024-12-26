<?php

//use App\Router;
//use Controllers\UserController;
//use Controllers\ToDoController;

use app\Models\User;

$user = new User();

//dd($user->getConn());
dd($user->createUser("Kamola","Kamola@gmail.com","2024"));
//Router::get('/todos', [ToDoController::class, 'index']);
//Router::get('/users', [UserController::class, 'show']);
//Router::get('/',function (){
//    echo "Hello World!";
//});