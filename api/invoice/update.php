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
$Invoice->paid = $_POST['paid'];
$Invoice->paid_date = $_POST['paid_date'];
$Invoice->comments = $_POST['comments'];
 
// create the Invoice
if($Invoice->update()){
    $invoice_arr=array(
        "status" => true,
        "message" => "Successfully Updated!"
    );
}
else{
    $invoice_arr=array(
        "status" => false,
        "message" => "Invoice No already exists!"
    );
}
print_r(json_encode($invoice_arr));
?>