<?php
header("Access-Control-Allow-Origin: *"); // Headers 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php'; // Inkludering av klasser
include_once '../objects/functions.php';
 
//______________________________________ |VARIABLER| ______________________________________
$database = new Database(); // Hämta databasanslutning
$db = $database->getConnection();
$values = new Functions($db); // Instantiera objekt
$data = json_decode(file_get_contents("php://input")); // Hämta id för uppdatering av värden

$values->id = $data->id; // Sätt egenskap för det ID som ska uppdateras
$values->kolumn_1 = $data->kolumn_1; // Variabler för databasens kolumner
$values->kolumn_2 = $data->kolumn_2;
$values->kolumn_3 = $data->kolumn_3;

//______________________________________ |FUNKTION| ______________________________________
if($values->update()){ // Uppdatera kursen vid lyckad anslutning
    http_response_code(200); // responskod - 200 ok
    echo json_encode(array("message" => "value was updated.")); // Skriv ut att värdet uppdateras
} else { // Respons vid misslyckad anslutning
    http_response_code(503); // responskod - 503 service unavailable
    echo json_encode(array("message" => "Unable to update values.")); // Skriv ut att värden ej kunde uppdateras
} ?>