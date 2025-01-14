<?php

namespace Src;
use App\Models\DB;
use App\Models\User;

class Auth{
    public static function getToken(): array|string{
        $headers = getallheaders();
        if(!isset($headers['Authorization'])){
            apiResponse([
                'errors' => ['message' => 'Unauthorized']
                ]);
        }
        if(!str_starts_with($headers['Authorization'], 'Bearer ')){
            apiResponse([
                'message' => 'Authorization format is invalid, allowed format is Bearer'
            ],400);
        }
        return str_replace('Bearer ', '', $headers['Authorization']);
    }
    public static function getCorrectUserToken(){
        $db = new DB();
        $pdo = $db->getConnection();
        $query = "SELECT * FROM user_api_tokens WHERE token = :token and expires_at >= NOW()";
        $stmt = $pdo->prepare($query);
        $stmt->execute([':token' => self::getToken()]);
        return $stmt->fetch();
    }
    public static function check(): bool{
        if(!self::getCorrectUserToken()){
            apiResponse([
                'message' => 'Unauthorized'
            ],401);
        }
        return true;
    }
    public static function user(){
        $token = self::getCorrectUserToken();
        if(!$token){
            apiResponse([
                'errors' => ['message' => 'Unauthorized']
                ],401);
        }
        $user = new User();
        return $user->getUserById($token->user_id);
    }
}