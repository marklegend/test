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
$stmt = $Dashboard->todaybirthread();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // birthday array
    $birthday_arr=array();
    $birthday_arr["birthday"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $birthday_item=array(
            "client_id" => $client_id,
            "client_name" => $client_name
           
           
        );
        array_push($birthday_arr["birthday"], $birthday_item);
    }
 
    echo json_encode($birthday_arr["birthday"]);
}
else{
    echo json_encode(array());
}

?>