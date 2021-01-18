<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/operator.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare operator object
$operator = new operator($db);
 
// set operator property values
$operator->id = $_POST['id'];
$operator->name = $_POST['name'];
$operator->username = $_POST['username'];
$operator->password = base64_encode($_POST['password']);
 
// create the operator
if($operator->update()){
    $operator_arr=array(
        "status" => true,
        "message" => "Successfully Updated!"
    );
}
else{
    $operator_arr=array(
        "status" => false,
        "message" => "username already exists!"
    );
}
print_r(json_encode($operator_arr));
?>