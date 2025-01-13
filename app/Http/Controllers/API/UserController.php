<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Traits\Validator;

class UserController{
    use Validator;

    public function storeUser (): void {
        $userData = $this->validate([
            'full_name' => 'string',
            'email' => 'string',
            'password' => 'string'
        ]);
        $user = new User();
        $user->createUser($userData['full_name'], $userData['email'], $userData['password']);
        apiResponse(['message' => 'User created successfully',
                     'token' => $user->api_token,
                    ], 201);
    }
    public function login(): void{
        $userData = $this->validate([
            'email' => 'string',
            'password' => 'string'
        ]);
        $user = new User();
        if ($user->getUser($userData['email'], $userData['password'])){
            apiResponse([
                'message' => 'User logged in successfully',
                'token' => $user->api_token,
                ]);
        }
        apiResponse([
            'errors' => [
                'message' => 'Email or password is incorrect'
            ]
            ],401);
    }

    public function show(){
        apiResponse([
            'user' => [
                'name' => 'John Doe',
                'email' => 'john@doe.com',
            ]
        ]);
    }
}