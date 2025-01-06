<?php

use Src\Router;

Router::get('/', function (){
    view('home');
});