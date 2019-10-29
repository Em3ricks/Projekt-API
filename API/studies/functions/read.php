<?php
header("Access-Control-Allow-Origin: *"); // Headers
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET"); 
include '../config/database.php'; // Inkludering av klasser
include '../objects/functions.php';
 
$database = new Database(); // Instantiering av klasser
$db = $database->getConnection();
$db_values = new Functions($db);
$stmt = $db_values->read(); // Läs ut värden från databas
$num = $stmt->rowCount();
 
if($num>0){ // Kontrollera om innehåll hittats
    $db_values_arr=array(); // Skapar array innehållande databasens värden
    $db_values_arr["values"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){ // Hämta innehåll från tabell
        extract($row);
        $db_values_item = array(
            "id" => $id,
            "kolumn_1" => $kolumn_1,
            "kolumn_2" => $kolumn_2,
            "kolumn_3" => $kolumn_3
        );  // Lägger innehåll i en array och döper denna till values
        array_push($db_values_arr["values"], $db_values_item);
    }
    http_response_code(200); // Vid lyckad anslutning - 200 OK
    echo json_encode($db_values_arr); // Visa värden i json format
    
} else { // Vid misslyckad anslutning - 404 Not found
    http_response_code(404); 
    echo json_encode( // Skriv ut felmeddelande
        array("message" => "No data found.")
    );
}