<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
require_once '../config/database.php';
require_once '../objects/task.php';
  
$database = new Database();
$db = $database->getConnection();
  
$task = new Task($db);
  
$stmt = $task->read();
$num = $stmt->rowCount();
  
if($num>0){
  
    $tasks_arr=array();
    $tasks_arr["records"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        
        $task_item=array(
            "id" => $id,
            "user_id" => $user_id,
            "title" => html_entity_decode($title),
            "description" => html_entity_decode($description),
            "date" => html_entity_decode($date),
            "status" => html_entity_decode($status)
        );
  
        array_push($tasks_arr["records"], $task_item);
    }
  
    http_response_code(200);
  
    echo json_encode($tasks_arr);
}
  
else{  
    http_response_code(404);
  
    echo json_encode(
        array("message" => "Error 404 - No tasks found is the database.")
    );
}
