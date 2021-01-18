<?php
class Dashboard{
 
    // database connection and table name
    private $conn;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    
     // read all Dashboards
     function unpaidinvread(){
    
        // select all query
        $query = "SELECT
        I.CLIENT_ID 'client_id',
        CONCAT(C.C_NAME,' ', C.C_SURNAME) 'client',
        I.INV_NUM 'invoice_no',
        I.INV_DATE 'invoice_date'
        FROM
        invinfo I , clientinfo C
        WHERE
        I.inv_date<'2020-01-02' AND I.INV_PAID<>'Y'
        AND
        I.Client_id = C.Client_id
        ORDER BY I.Inv_Date ASC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

     // read all Dashboards
     function topsellingread(){
    
        // select all query
        $query = "SELECT
        count(extract(month from Inv_Date)) 'nopurchase',
        monthname(Inv_Date) 'month'
        FROM invinfo
        GROUP BY MONTH
        ORDER BY extract(month from Inv_Date)";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

     // read all Dashboards
     function todaybirthread(){
    
        // select all query
        $query = "SELECT
        Client_id 'client_id', CONCAT(C_NAME,' ',C_SURNAME) 'client_name'
        FROM clientinfo
        WHERE
        SUBSTRING(CLIENT_ID,3,2) = EXTRACT(MONTH FROM CURRENT_DATE)
        AND
        SUBSTRING(CLIENT_ID,5,2) = EXTRACT(DAY FROM CURRENT_DATE)";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

     // read all Dashboards
     function minstockread(){
    
        // select all query
        $query = "SELECT
        S.SUPPLEMENT_ID 'supple',
        CONCAT(S.SUPPLIER_ID,' ',C.Contact_Person,' ',C.Supplier_Tel) 'supplier_info',
        S.Min_levels 'min_lvls',
        S.Current_stock_levels 'curstock'
        FROM `supplements` S, supplierinfo C
        WHERE Current_stock_levels < Min_levels
        AND S.SUPPLIER_ID = C.Supplier_ID
        ORDER BY S.SUPPLIER_ID
        LIMIT 10";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

     // read all Dashboards
     function topclientsread(){
    
        // select all query
        $query = "SELECT
        count(I.client_id) 'freq',
        concat(I.CLIENT_ID,' ',C.c_name,' ', C.C_surname) 'client'
        FROM
        invinfo I, clientinfo C
        WHERE
        extract(year from inv_date) in ('2018','2019')
        AND
        I.Client_id = C.Client_id
        GROUP BY I.client_id
        ORDER BY count(I.client_id) desc
        LIMIT 10";
        
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

     // read all Dashboards
     function quickcontactread(){
    
        // select all query
        $query = "SELECT
        Client_id 'client', C_Tel_H 'home',
        C_Tel_W 'work', C_Tel_C 'cell', C_Email 'email'
        FROM clientinfo
        WHERE NULLIF(C_TEL_C,' ') IS NULL
        AND NULLIF(C_EMAIL,' ') IS NULL";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // get single Dashboard data
    function read_single(){
    
        // select all query
        $query = "SELECT
                    `id`, `name`, `email`, `password`, `phone`, `gender`, `position`, `created`
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

 
 
}