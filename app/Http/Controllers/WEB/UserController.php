<?php

namespace App\Http\Controllers\WEB;

class UserController{
    public function home(){
        view('dashboard/home');
    }
    public function update(int $id){
        view('dashboard/update-quiz',['id' => $id]);
    }
}