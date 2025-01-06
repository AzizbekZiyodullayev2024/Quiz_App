<?php

namespace App\Http\Controllers\API;

class QuizController{
    public function store (){
        $headers = getallheaders();
        $bearer = $headers['Authorization'];
        $token = str_replace('Bearer ', '', $bearer);
        dd($token);
    }
}