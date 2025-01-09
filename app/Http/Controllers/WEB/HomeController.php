<?php

namespace App\Http\Controllers\WEB;

class HomeController{
    public function home(): void{
        view('home');
    }
    public function login(){
        view('auth/login');
    }
    public function my_quizzes(){
        view('my_quizzes');
    }
    public function statistics(){
        view('statistics');
    }
    public function dashboard(){
        view('dashboard');
    }
    public function create_quiz(){
        view('create_quiz');
    }
    public function register(){
        view('auth/register');
    }
    public function about(): void{
        view('about');
    }
}