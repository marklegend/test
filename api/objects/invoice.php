<?php
class Invoice{
 
    // database connection and table name
    private $conn;
    private $table_name = "Invoices";
 
    // object properties
    public $id;
    public $customer_id;
    public $descript;
    public $amount;
    public $date;
    
    
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read all Invoices
    function read(){
    
        // select all query
        $query = "SELECT
                    num As id , Inv_Num As invnum, Client_id As client, Inv_Date As invdate, Inv_Paid As paid, Inv_Paid_Date As paid_date, Comments As comments
                FROM
                    " . $this->table_name . " 
                
                ORDER BY
                    num DESC
                    LIMIT 50";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single Invoice data
    function read_single(){
    
        // select all query
        $query = "SELECT
        num As id , Inv_Num As invnum, Client_id As client, Inv_Date As invdate, Inv_Paid As paid, Inv_Paid_Date As paid_date, Comments As comments
                FROM
                    " . $this->table_name . " 
                WHERE
                    num= '".$this->id."'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
        return $stmt;
    }

    // create Invoice
    function create(){
    
        if($this->isAlreadyExist()){
            return false;
        }
        
        // query to insert record
        $query = "INSERT INTO  ". $this->table_name ." 
                        (`inv_Num`, `Client_id`, `Inv_Date`, `Inv_Paid`, `Inv_Paid_Date`, `Comments`)
                  VALUES
                        ('".$this->invnum."', '".$this->client."', '".$this->invdate."', '".$this->paid."', '".$this->paid_date."', '".$this->comments."')";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if($stmt->execute()){
            $this->id = $this->conn->lastInsertId();
            return true;
        }

        return false;
    }

    // update Invoice 
    function update(){
    
        // query to insert record
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    Inv_Paid='".$this->paid."', Inv_Paid_Date='".$this->paid_date."', Comments='".$this->comments."'
                WHERE
                    num='".$this->id."'";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete Invoice
    function delete(){
        
        // query to insert record
        $query = "DELETE FROM
                    " . $this->table_name . "
                WHERE
                    num= '".$this->id."'";
        
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
                Inv_Num='".$this->invnum."'";

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