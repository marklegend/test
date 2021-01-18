<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/operator.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare operator object
$operator = new Operator($db);
 
// set operator property values
$operator->id = $_POST['id'];
 
// remove the operaotor
if($operator->delete()){
    $operator_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $operator_arr=array(
        "status" => false,
        "message" => "operator cannot be deleted!"
    );
}
print_r(json_encode($operator_arr));
?>