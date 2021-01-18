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
$stmt = $Dashboard->quickcontactread();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // quick contacts array
    $contacts_arr=array();
    $contacts_arr["contacts"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $contact_item=array(
            "client" => $client,
            "home" => $home,
            "work" => $work,
            "cell" => $cell,
            "email" => $email
           
        );
        array_push($contacts_arr["contacts"], $contact_item);
    }
 
    echo json_encode($contacts_arr["contacts"]);
}
else{
    echo json_encode(array());
}

?>