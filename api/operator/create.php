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
$operator->name = $_POST['name'];
$operator->username = $_POST['username'];
$operator->password = base64_encode($_POST['password']);

// create the operator
if($operator->create()){
    $operator_arr=array(
        "status" => true,
        "message" => "Successfully Signup!, Welcome new operator",
        "id" => $operator->id,
        "name" => $operator->name,
        "username" => $operator->username,
    );
}
else{
    $operator_arr=array(
        "status" => false,
        "message" => "operator username already exists!"
    );
}
print_r(json_encode($operator_arr));
?>