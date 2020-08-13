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

    public function query($sql){
        $result = mysqli_query($this->connection, $sql);

        return $result
    }

    private function confirm_query($query){
        if(!$result){
            die('Query Failed');
        }
    }

    public function escape_string($string){
        $escaped_string = mysqli_real_escape_string($this->connection, $string);
        return $escaped_string;
    }
}

$db = new Database;