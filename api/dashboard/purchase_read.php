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

$stmt = $Dashboard->topsellingread();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // purchase array
    $purchase_arr=array();
    $purchase_arr["purchase"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $Dashboard_item=array(
            "nopurchase" => $nopurchase,
            "month" => $month
            
           
        );
        array_push($purchase_arr["purchase"], $Dashboard_item);
    }
 
    echo json_encode($purchase_arr["purchase"]);
}
else{
    echo json_encode(array());
}
?>