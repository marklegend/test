<?php
class Operator{
 
    // database connection and table name
    private $conn;
    private $table_name = "operators";
 
    // object properties
    public $id;
    public $name;
    public $username;
    public $password;

 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

// signup operator
function signup(){
    
    if($this->isAlreadyExist()){
        return false;
    }
    // query to insert record
    $query = "INSERT INTO
                " . $this->table_name . "
                ( `name`, `password`)
            VALUES
            ( '".$this->name."', '".$this->password."')"; 

    // prepare query
    $stmt = $this->conn->prepare($query);

       // execute query
    if($stmt->execute()){
        $this->id = $this->conn->lastInsertId();
        return true;
    }

    return false;
    
}
// login operator
function login(){
    // select all query
    $query = "SELECT
                `id`, `name`, `username`, `password`
            FROM
                " . $this->table_name . " 
            WHERE
                username='".$this->username."' AND password='".$this->password."'";
    // prepare query statement
    $stmt = $this->conn->prepare($query);
    // execute query
    $stmt->execute();
    return $stmt;
}


    // read all operators
    function read(){
    
        // select all query
        $query = "SELECT
                    `id`, `name`, `username`, `password`
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id DESC
                    LIMIT 10";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single operator data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `id`, `name`, `username`, `password`
                FROM
                    " . $this->table_name . " 
                WHERE
                    id= '".$this->id."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create operator
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`name`, `username`, `password`)
                  VALUES
                        ('".$this->name."', '".$this->username."', '".$this->password."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update operator
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', username='".$this->username."', password='".$this->password."'
                WHERE
                    id='".$this->id."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete operator
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    id= '".$this->id."'";
        
        // prepare query
        $stmt = $this->conn->prepare($query);
        
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                username='".$this->username."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}