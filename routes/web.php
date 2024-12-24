<?php

use App\Router;
use Controllers\UserController;

Router::get('/', fn () => (new UserController())->index());
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