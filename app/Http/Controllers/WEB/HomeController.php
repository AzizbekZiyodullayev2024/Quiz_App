<?php

namespace App\Http\Controllers\WEB;

class HomeController{
    public function home(): void{
        view('home');
    }
    public function login(){
        view('auth/login');
    }
    public function about(): void{
        view('about');
    }
}