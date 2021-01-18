<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/customer.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare customer object
$customer = new Customer($db);
 
// query customer
$stmt = $customer->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // customers array
    $customers_arr=array();
    $customers_arr["customers"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $customer_item=array(
           
            "id" => $id,
            "name" => $name,
            "username" => $username,
            "address" => $address,
            "password" => $password,
            "balance" => $balance,
            "date_created" => $date_created
        );
        array_push($customers_arr["customers"], $customer_item);
    }
 
    echo json_encode($customers_arr["customers"]);
}
else{
    echo json_encode(array());
}
?>