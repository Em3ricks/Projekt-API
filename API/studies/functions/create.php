<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include '../config/database.php';
include '../objects/functions.php';
 
$db_connection = new Database();
$conn = $db_connection->getConnection();
$data = json_decode(file_get_contents("php://input")); // GET DATA FORM REQUEST
$msg['message'] = '';//CREATE MESSAGE ARRAY AND SET EMPTY

if( // CHECK IF RECEIVED DATA FROM THE REQUEST
isset($data->kolumn_1) && 
isset($data->kolumn_2) && 
isset($data->kolumn_3)){
    if( // Kontroll om värden är ifyllda
    !empty($data->kolumn_1) && 
    !empty($data->kolumn_2) && 
    !empty($data->kolumn_3))
    {
        $insert_query = "INSERT INTO `studies`(kolumn_1, kolumn_2, kolumn_3) 
        VALUES(:kolumn_1, :kolumn_2, :kolumn_3)";
        $insert_stmt = $conn->prepare($insert_query); // Förbereder ovanstående SQL-fråga
        $insert_stmt->bindValue(':kolumn_1', htmlspecialchars(strip_tags($data->kolumn_1)),PDO::PARAM_STR); // Binder värden
        $insert_stmt->bindValue(':kolumn_2', htmlspecialchars(strip_tags($data->kolumn_2)),PDO::PARAM_STR);
        $insert_stmt->bindValue(':kolumn_3', htmlspecialchars(strip_tags($data->kolumn_3)),PDO::PARAM_STR);
        
        if($insert_stmt->execute()){ // Exikvering och meddelande vid lyckad/misslyckad fråga
            $msg['message'] = 'Data Inserted Successfully';
        } else {
            $msg['message'] = 'Data not Inserted';
        } 
    } 
}

//ECHO DATA IN JSON FORMAT
echo json_encode($msg);

 


