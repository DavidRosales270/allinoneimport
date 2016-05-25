<?php
/**
 * Created by PhpStorm.
 * User: David Rosales
 * Date: 28/4/2016
 * Time: 10:00 AM
 */

class Product{
    // database connection and table name
    private $conn;
    private $table_name = "products";

    // object properties
    public $id;
    public $name;
    public $manufacturer;
    public $part_no;
    public $created;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // create product
    function create(){

        // query to insert record
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, part_no=:part_no, manufacturer=:manufacturer, created=:created";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // posted values
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->part_no=htmlspecialchars(strip_tags($this->part_no));
        $this->manufacturer=htmlspecialchars(strip_tags($this->manufacturer));

        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":part_no", $this->part_no);
        $stmt->bindParam(":manufacturer", $this->manufacturer);
        $stmt->bindParam(":created", $this->created);

        // execute query
        if($stmt->execute()){
            return true;
        }else{
            echo "<pre>";
            print_r($stmt->errorInfo());
            echo "</pre>";

            return false;
        }
    }

}