<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/customer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare customer object
$customer = new Customer($db);

// set ID property of customer to be edited
$customer->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of customer to be edited
$stmt = $customer->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $customer_arr=array(
        "id" => $row['id'],
        "name" => $row['name'],
        "username" => $row['username'],
        "address" => $row['address'],
        "password" => $row['password'],
        "balance" => $row['balance']
     
    );
}
// make it json format
print_r(json_encode($customer_arr));
?>