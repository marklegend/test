<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/invoice.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare Invoice object
$Invoice = new Invoice($db);
 
// set Invoice property values
$Invoice->id = $_POST['id'];
 
// remove the Invoice
if($Invoice->delete()){
    $invoice_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $invoice_arr=array(
        "status" => false,
        "message" => "Invoice Cannot be deleted right now,be patient!"
    );
}
print_r(json_encode($invoice_arr));
?>