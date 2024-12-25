<?php

//use App\Router;
//use Controllers\UserController;
//use Controllers\ToDoController;

use App\Models\User;

$user = new User();

//dd($user->getConn());
dd($user->createUser("Azizbek","azizbek@gmail.com","2017"));

//Router::get('/todos', [ToDoController::class, 'index']);
//Router::get('/users', [UserController::class, 'show']);
//Router::get('/',function (){
//    echo "Hello World!";
//});