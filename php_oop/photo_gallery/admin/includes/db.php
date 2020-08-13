<?php
require_once('db_config.php');

class Database {

    public $connection;

    function __construct(){
        $this->db_connect();
    }

    public function db_connect() {
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
        if(mysqli_connect_errno()){
            die('Database connection failed. ' . mysqli_error());
        }
    }
}

$db = new Database;