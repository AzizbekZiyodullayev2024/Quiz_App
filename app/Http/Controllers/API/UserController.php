<?php

namespace App\Http\Controllers\API;
use App\Models\User;
use App\Traits\Validator;

class UserController{
    use Validator;

    public function store (){
        $userData = $this->validate([
            'full_name' => 'string',
            'email' => 'string',
            'password' => 'string'
        ]);
        $user = new User();
        $user->createUser($userData['full_name'], $userData['email'], $userData['password']);
        apiResponse(['message' => 'User created successfully'], 201);
    }
}
