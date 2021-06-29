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
$data->name = isset($_GET['name']) ? $_GET['name'] : die("Name is missing");
$data->email = isset($_GET['email']) ? $_GET['email'] : die("Email is missing");
$data->id = isset($_GET['id']) ? $_GET['id'] : die("ID is missing");

$user->id = $data->id;
  
$user->name = $data->name;
$user->email = $data->email;
  
if($user->update()){
    http_response_code(200);
    echo json_encode(array("message" => "User was updated."));
}
  
else{
    http_response_code(503);  
    echo json_encode(array("message" => "Error 503 - Unable to update user."));
}
?>