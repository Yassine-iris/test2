<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../config/database.php';
include_once '../objects/task.php';
  
$database = new Database();
$db = $database->getConnection();
  
$task = new Task($db);
  
#$data = json_decode(file_get_contents("php://input"));
$data->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : die('User missing');
$data->title = isset($_GET['title']) ? $_GET['title'] : die('Title missing');
$data->description = isset($_GET['description']) ? $_GET['description'] : die('Description missing');
$data->status = isset($_GET['status']) ? $_GET['status'] : 'created'; 
$data->id = isset($_GET['id']) ? $_GET['id'] : die("ID is missing"); 
$data->date = date('Y-m-d H:i:s');
$task->id = $data->id;
  
$task->user_id = $data->user_id;
$task->title = $data->title;
$task->description = $data->description;
$task->status = $data->status;
$task->date = $data->date;

if($task->update()){
  
    http_response_code(200);  
    echo json_encode(array("message" => "Task was updated."));
}
  
else{  
    http_response_code(503);  
    echo json_encode(array("message" => "Unable to find this task in the database."));
}
?>