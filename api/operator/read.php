<?php
// include database and object files
include_once '../config/database.php';
include_once '../objects/operator.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare  operator object
$operator = new Operator($db);
 
// query operator
$stmt = $operator->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
 
    // operators array
    $operators_arr=array();
    $operators_arr["operator"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $operator_item=array(
            "id" => $id,
            "name" => $name,
            "username" => $username,
            "password" => $password,
        );
        array_push($operators_arr["operator"], $operator_item);
    }
 
    echo json_encode($operators_arr["operator"]);
}
else{
    echo json_encode(array());
}
?>