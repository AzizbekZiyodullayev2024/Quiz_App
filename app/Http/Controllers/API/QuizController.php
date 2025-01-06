<?php

namespace App\Http\Controllers\API;
use Src\Auth;
class QuizController{
    public function store (){
        if(Auth::check()){
            $headers = getallheaders();
            $bearer = $headers['Authorization'];
            $token = str_replace('Bearer ', '', $bearer);
            dd($token);
        }
    }
}