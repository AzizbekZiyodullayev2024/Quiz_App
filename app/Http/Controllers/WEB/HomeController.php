<?php

namespace App\Http\Controllers\WEB;

class HomeController{
    public function home(): void{
        view('home');
    }
    public function login(){
        view('auth/login');
    }
    public function quizzes(){
        view('/quiz/quizzes');
    }
    public function statistics(){
        view('/dashboard/statistics');
    }
    public function dashboard(): void
    {
        view('dashboard');
    }
    public function create_quiz(): void
    {
        view('/dashboard/create_quiz');
    }
    public function register(): void
    {
        view('auth/register');
    }
    public function about(): void{
        view('about');
    }
}