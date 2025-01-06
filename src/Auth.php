<?php

namespace Src;

use App\Models\DB;

class Auth{
    public function check(): bool{
        $headers = getallheaders();
        if(!isset($headers['Authorization'])){
            apiResponse([
                'message' => 'Unauthorized'
            ]);
        }
        if(!str_starts_with($headers['Authorization'], 'Bearer ')){
            apiResponse([
                'message' => 'Authorization format is invalid, allowed format is Bearer'
            ],400);
        }
        $token = str_replace('Bearer ', '', $headers['Authorization']);
        $db = new DB();
        $query = "SELECT * FROM users WHERE `token` = '$token'";
        $stmt = $db->conn->prepare($query);

        return true;
    }
}