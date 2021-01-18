<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/dashboard.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare Dashboard object
$Dashboard = new Dashboard($db);
 
// query Dashboard
$stmt = $Dashboard->minstockread();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // Dashboards array
    $minlvls_arr=array();
    $minlvls_arr["minlvls"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $minlvls_item=array(
            "supple" => $supple,
            "supplier_info" => $supplier_info,
            "min_lvls" => $min_lvls,
            "curstock" => $curstock
           
        );
        array_push($minlvls_arr["minlvls"], $minlvls_item);
    }
 
    echo json_encode($minlvls_arr["minlvls"]);
}
else{
    echo json_encode(array());
}

?>