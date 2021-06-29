<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

include_once '../objects/user.php';
  
$database = new Database();
$db = $database->getConnection();
  
$user = new User($db);

#$data = json_decode(file_get_contents("php://input"));
$data->name = isset($_GET['name']) ? $_GET['name'] : die('Name is missing');
$data->email = isset($_GET['email']) ? $_GET['email'] : die('Email is missing');
if(
    !empty($data->name) &&
    !empty($data->email)
){

    $user->name = $data->name;
    $user->email = $data->email;
  
    if($user->create()){
  
        http_response_code(201);
  
        echo json_encode(array("message" => "User was created."));
    }
  
    else{
  
        http_response_code(503);
  
        echo json_encode(array("message" => "Error 503 - Unable to create the new user."));
    }
}
else{
  
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create a new user. Data is incomplete."));
}
?>