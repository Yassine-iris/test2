<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
require_once '../config/core.php';
require_once '../shared/utilities.php';
require_once '../config/database.php';
include_once '../objects/user.php';
  
$utilities = new Utilities();
  
$database = new Database();
$db = $database->getConnection();
  
$user = new User($db);
  
$stmt = $user->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();
  
if($num>0){
  
    $users_arr=array();
    $users_arr["records"]=array();
    $users_arr["paging"]=array();
  
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
  
        $user_item=array(
            "id" => $id,
            "name" => $name,
            "email" => $email
        );
  
        array_push($users_arr["records"], $user_item);
    }
  
  
    $total_rows=$user->count();
    $page_url="{$home_url}user/read_paging.php?";
    $paging=$utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
    $users_arr["paging"]=$paging;
  
    http_response_code(200);
  
    echo json_encode($users_arr);
}
  
else{
  
    http_response_code(404);  
    echo json_encode(
        array("message" => "Error 404 - No users found in the database.")
    );
}
?>