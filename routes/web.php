<?php

use App\Router;

Router::get('/', function () use ($router) {
    echo "Hello World!";
});