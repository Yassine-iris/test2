<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
include_once '../config/database.php';
include_once '../objects/task.php';
  
$database = new Database();
$db = $database->getConnection();
  
$task = new Task($db);
  
$task->id = isset($_GET['id']) ? $_GET['id'] : die('ID is missing');
  
$task->readOne();
  
if($task->id!=null){
    $task_arr = array(
        "id" => $task->id,
        "title" => $task->title,
        "user_id" => $task->user_id,
        "description" => $task->description,
        "date" => $task->date,
        "status" => $task->status
    );
  
    http_response_code(200);
  
    echo json_encode($task_arr);
}
  
else{
    http_response_code(404);
    echo json_encode(array("message" => "Error 404 - Task does not exist."));
}
?>