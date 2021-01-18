<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/Dashboard.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare Dashboard object
$Dashboard = new Dashboard($db);
 
// query Dashboard
$stmt = $Dashboard->unpaidinvread();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // unpaid array
    $unpaid_arr=array();
    $unpaid_arr["unpaid"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $unpaid_item=array(
            "client_id" => $client_id,
            "client" => $client,
            "invoice_no" => $invoice_no,
            "invoice_date" => $invoice_date
           
        );
        array_push($unpaid_arr["unpaid"], $unpaid_item);
    }
 
    echo json_encode($unpaid_arr["unpaid"]);
}
else{
    echo json_encode(array());
}

?>