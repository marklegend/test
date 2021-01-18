<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/customer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare customer object
$customer = new Customer($db);

// set customer property values
$customer->id = $_POST['id'];
$customer->name = $_POST['name'];
$customer->username = $_POST['username'];
$customer->address = $_POST['address'];
$customer->balance = $_POST['balance'];
 
// create the customer
if($customer->update()){
    $customer_arr=array(
        "status" => true,
        "message" => "Successfully Updated!"
    );
}
else{
    $customer_arr=array(
        "status" => false,
        "message" => "Check your input, it may contain errors!"
    );
}
print_r(json_encode($customer_arr));
?>