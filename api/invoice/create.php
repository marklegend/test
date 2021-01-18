<?php
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/invoice.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare Invoice object
$Invoice = new Invoice($db);

$static = 'inv';

$ran = rand(00000, 99999);

$invnum = $static . $ran;

 
// set Invoice property values
$Invoice->invnum = $invnum;
$Invoice->client = $_POST['client'];
$Invoice->invdate = $_POST['invdate'];
$Invoice->paid = $_POST['paid'];
$Invoice->paid_date = $_POST['paid_date'];
$Invoice->comments = $_POST['comments'];


// create the Invoice
if($Invoice->create()){
    $Invoice_arr=array(
        "status" => true,
        "message" => "Successfully logged a new invoice!",
        "id" => $Invoice->id,
        "invnum" => $Invoice->invnum,
        "client" => $Invoice->client,
        "invdate" => $Invoice->invdate,
        "paid" => $Invoice->paid,
        "paid_date" => $Invoice->paid_date,
        "comments" => $Invoice->comments
    );
}
else{
    $Invoice_arr=array(
        "status" => false,
        "message" => "Invoice No already exists!"
    );
}
print_r(json_encode($Invoice_arr));
?>