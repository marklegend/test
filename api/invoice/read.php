<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/invoice.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare Invoice object
$Invoice = new Invoice($db);
 
// query Invoice
$stmt = $Invoice->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // Invoices array
    $invoices_arr=array();
    $invoices_arr["Invoices"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $invoice_item=array(
            "id" => $id,
            "invnum" => $invnum,
            "client" => $client,
            "invdate" => $invdate,
            "paid" => $paid,
            "paid_date" => $paid_date,
            "comments" => $comments
            
        );
        array_push($invoices_arr["Invoices"], $invoice_item);
    }
 
    echo json_encode($invoices_arr["Invoices"]);
}
else{
    echo json_encode(array());
}
?>