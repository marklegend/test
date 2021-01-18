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
 
// remove the customer
if($customer->delete()){
    $customer_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $customer_arr=array(
        "status" => false,
        "message" => "customer Cannot be deleted right now. be patient!"
    );
}
print_r(json_encode($customer_arr));
?>