<?php

//use App\Router;
//use Controllers\UserController;
//use Controllers\ToDoController;
use Src\Router;

Router::get('/', function (){
    echo    '<h1>Hello World</h1>>';
});

//dd($user->getConn());
//dd($user->createUser("Kamola","Kamola@gmail.com","2024"));
//Router::get('/todos', [ToDoController::class, 'index']);
//Router::get('/users', [UserController::class, 'show']);
//Router::get('/',function (){
//    echo "Hello World!";
//});