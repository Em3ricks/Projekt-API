<?php
class Functions {
    //______________________________________ |VARIABLER| ______________________________________
    private $conn; // Databasanslutning och tabellnamn
    private $table_name = "studies";
    public $kolumn_1; // Objektvariablier
    public $kolumn_2;
    public $kolumn_3;
    public $id;

    //______________________________________ |FUNKTIONER| ______________________________________
    public function __construct($db){ // Konstruktor
        $this->conn = $db;
    }

    //______________________________________ (READ) ______________________________________
    function read() { 
        $query = "SELECT * FROM $this->table_name"; // SQL-fråga för att välja samtliga värden
        $stmt = $this->conn->prepare($query); // Förberedelse av förfrågan
        $stmt->execute(); // Exikvering av förfrågan
        return $stmt;
    }

    //______________________________________ (DELETE) ______________________________________
    function delete(){ 
        $query = "DELETE FROM $this->table_name WHERE id = ?"; // Förfrågan för att ta bort värde med koppling till dess id
        $stmt = $this->conn->prepare($query); // Förbereder SQL-fråga
        $this->id=htmlspecialchars(strip_tags($this->id)); // Tar bort taggar
        $stmt->bindParam(1, $this->id); // Kopplar id som ska raderas
        if($stmt->execute()){ // Exikvering av SQL-fråga
            return true;
        }   return false;
    }

    //______________________________________ (UPDATE) ______________________________________
    function update(){ 
        $query = "UPDATE $this->table_name SET
            kolumn_1 = :kolumn_1,
            kolumn_2 = :kolumn_2,
            kolumn_3 = :kolumn_3                                    
            WHERE id = :id"; // SQL-fråga för uppdatering av tabell
        $stmt = $this->conn->prepare($query); // Förbereder SQL-fråga

        $this->kolumn_1=htmlspecialchars(strip_tags($this->kolumn_1)); // Tar bort taggar
        $this->kolumn_2=htmlspecialchars(strip_tags($this->kolumn_2));
        $this->description=htmlspecialchars(strip_tags($this->kolumn_3));
        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':kolumn_1', $this->kolumn_1); // Binder nya värden
        $stmt->bindParam(':kolumn_2', $this->kolumn_2);
        $stmt->bindParam(':kolumn_3', $this->kolumn_3);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){ // Exikvering av SQL-fråga
            return true;
        }   return false;
    }     
}

