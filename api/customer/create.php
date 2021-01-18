<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/customer.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare customer object
$customer = new Customer($db);
 
$date = date();


// set customer property values
$customer->id = $_POST['id'];
$customer->name = $_POST['name'];
$customer->username = $_POST['username'];
$customer->address= $_POST['address'];
$customer->password = base64_encode($_POST['passoword']);
$customer->balance = $_POST['balance'];
$customer->date_created = $date;



// create the customer
if($customer->create()){
    $customer_arr=array(
        "status" => true,
        "message" => "Just added a new customer!",
        "id" => $customer->id,
        "name" => $customer->name,
        "username" => $customer->username,
        "address" => $customer->address,
        "password" => $customer->password,
        "balance" => $customer->balance,
        "date_created" => $customer->date_created
       
    );
}
else{
    $customer_arr=array(
        "status" => false,
        "message" => "customer already exists!"
    );
}
print_r(json_encode($customer_arr));
?>