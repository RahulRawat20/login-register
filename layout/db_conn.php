<?php

#--databse connection

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "user_register_form";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if ($this->conn->connect_error) {
            die("Database Connection Failed: " . $this->conn->connect_error);
        }
    }
}
?>
