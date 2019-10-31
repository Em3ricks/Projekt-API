<?php // Klass för hantering av databasanslutning
class Database { // Specifikation av databasanslutning
    private $host = "localhost"; 
    private $db_name = "joem1800";
    private $username = "root";
    private $password = "";
    public $conn; 

    public function getConnection() { // Funktion för att hämta databasanslutning
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . 
            $this->host . ";dbname=" . 
            $this->db_name, 
            $this->username, 
            $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
} ?>
