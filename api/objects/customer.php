<?php
class Customer{
 
    // database connection and table name
    private $conn;
    private $table_name = "customers";
 
    // object properties
    public $id;
    public $name;
    public $username;
    public $password;
    public $address;
    public $balance;
    public $date_created;
   
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all customers
    function read(){
    
        // select all query
        $query = "SELECT
                     `id`, `name` , `username` , `address` , `password`,`balance` ,`date_created` 
               
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    id 
                    LIMIT 10";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single customer data
    function read_single(){
    
        // select all query
        $query = "SELECT
                  `id`, `name` , `username` , `address` , `password`,`balance`
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

    // create customer
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`name` , `username` , `address` , `password`,`balance` ,`date_created` )
                  VALUES
                        ( '".$this->name."', '".$this->username."', '".$this->address."', '".$this->password."', '".$this->balance."', '".$this->date_created."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update customer 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name='".$this->name."', username='".$this->username."', address='".$this->address."', password='".$this->password."', balance='".$this->balance."'
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

    // delete customer
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