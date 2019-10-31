<?php // Klass för hantering av databasanslutning
class Database { // Specifikation av databasanslutning
    public $host = "studentmysql.miun.se";
    public $db_name = "joem1800";
    public $username = "joem1800";
    public $password = "g8wmt1wr";
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
