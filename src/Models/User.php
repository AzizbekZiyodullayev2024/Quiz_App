<?php

namespace App\Models;

class User extends DB{
    public function getConn(): \PDO
    {
        return $this->conn;
    }
}