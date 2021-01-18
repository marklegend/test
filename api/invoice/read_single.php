<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/invoice.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare Invoice object
$Invoice = new Invoice($db);

// set ID property of Invoice to be edited
$Invoice->id = isset($_GET['id']) ? $_GET['id'] : die();

// read the details of Invoice to be edited
$stmt = $Invoice->read_single();

if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $invoice_arr=array(
        "id" => $row['id'],
        "invnum" => $row['invnum'],
        "client" => $row['client'],
        "invdate" => $row['invdate'],
        "paid" => $row['paid'],
        "paid_date" => $row['paid_date'],
        "comments" => $row['comments']       
    );
}
// make it json format
print_r(json_encode($invoice_arr));
?>