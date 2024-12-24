<?php

use App\Router;
use Controllers\UserController;
use Controllers\ToDoController;

Router::get('/todos', [ToDoController::class, 'show']);
Router::get('/users', [ToDoController::class, 'index']);

//Router::get('/', function () {
//    echo "Request Get";
//});
//
//Router::put('/', function () {
//    echo "Request Put";
//});
//
//Router::post('/', function () {
//    echo "Request Post";
//});
//
//Router::delete('/test/{id}', function () {
//    echo "Request Delete";
//});