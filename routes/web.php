<?php

use App\Router;

Router::get('/', function () {
    echo "Request Get";
});

Router::put('/', function () {
    echo "Request Put";
});

Router::post('/', function () {
    echo "Request Post";
});

Router::delete('/', function () {
    echo "Request Delete";
});