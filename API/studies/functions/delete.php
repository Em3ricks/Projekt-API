<?php
header("Access-Control-Allow-Origin: *"); // Headers
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
include_once '../config/database.php'; // Inkludera databas- och funktionsobjekt
include_once '../objects/functions.php';

//______________________________________ |VARIABLER| ______________________________________
$database = new Database(); // Databasanslutning
$db = $database->getConnection();
$value = new Functions($db); // Instantiering av objekt
$data = json_decode(file_get_contents("php://input")); // Hämta ID kopplat till värden
$value->id = $data->id; // Koppla ID som ska raderas
 
//______________________________________ |FUNKTION| ______________________________________
if ($value->delete()) { // Radera post med angivet ID
    http_response_code(200); // set response code - 200 ok
    echo json_encode(array("message" => "value was deleted.")); // tell the user
} else { // if unable to delete the value
    http_response_code(503); // set response code - 503 service unavailable
    echo json_encode(array("message" => "Unable to delete value.")); // tell the user
} ?>

