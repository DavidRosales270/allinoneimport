<?php
/**
 * Created by PhpStorm.
 * User: David Rosales
 * Date: 28/4/2016
 * Time: 9:53 AM
 */

class Database{

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "angular_php";
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    public function getConnection(){
        $this->conn = null;

        try{

            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}