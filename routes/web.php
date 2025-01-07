<?php

use Src\Router;
use App\Http\Controllers\WEB\HomeController;

Router::get('/',[HomeController::class,'home']);
Router::get('/about',[HomeController::class,'about']);