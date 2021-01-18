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
$stmt = $Dashboard->topclientsread();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // topclients array
    $topclients=array();
    $topclients["topclients"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $topclient_item=array(
            "freq" => $freq,
            "client" => $client
           
           
        );
        array_push($topclients["topclients"], $topclient_item);
    }
 
    echo json_encode($topclients["topclients"]);
}
else{
    echo json_encode(array());
}

?>