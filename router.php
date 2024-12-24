<?php

use App\Router;

if(Router::isApiCall()){
    require 'routes/api.php';
    exit();
}else if(Router::isTelegram()){
    require 'routes/telegram.php';
    exit();
}

require 'routes/web.php';