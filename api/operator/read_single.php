<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/operator.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare operator object
$operator = new Operator($db);

// set ID property of operator to be edited
$operator->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of operator to be edited
$stmt = $operator->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $operator_arr=array(
        "id" => $row['id'],
        "name" => $row['name'],
        "username" => $row['username'],
        "password" => $row['password']
    );
}
// make it json format
print_r(json_encode($operator_arr));
?>