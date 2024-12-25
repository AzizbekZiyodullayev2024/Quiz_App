<?php
namespace App\Models;
use PDO;
class DB{
    private string $db_name;
    private string $db_user;
    private string $db_password;
    private string $db_host;
    protected PDO $conn;
    public function __construct(){
        $this->db_user = $_ENV['DB_HOST'];
        $this->db_password = $_ENV['DB_PASSWORD'];
        $this->db_host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->conn = new PDO("msql:host=" . $this->db_host . ";dbname=" . $this->db_name, $this->db_user, $this->db_password);
    return $this->conn;
    }
}