<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
include_once '../config/core.php';
include_once '../shared/utilities.php';
include_once '../config/database.php';
include_once '../objects/task.php';
  
$utilities = new Utilities();
  
$database = new Database();
$db = $database->getConnection();
  
$user = new Task($db);
  
$stmt = $user->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
if($num>0){
  
    $tasks_arr=array();
    $tasks_arr["records"]=array();
    $tasks_arr["paging"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $user_item=array(
            "id" => $id,
            "user_id" => $user_id,
            "title" => $title,
            "description" => $description,
            "date" => $date,
            "status" => $status
        );
  
        array_push($tasks_arr["records"], $task_item);
    }
  
  
    $total_rows=$user->count();
    $page_url="{$home_url}task/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $users_arr["paging"]=$paging;
  
    http_response_code(200);
    echo json_encode($tasks_arr);
}
  
else{
    
    http_response_code(404);
    echo json_encode(
        array("message" => "No tasks found.")
    );
}
?>