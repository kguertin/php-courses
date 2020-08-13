<?php
require_once('db_config.php');

class Database {

    public $connection;

    function __construct(){
        $this->db_connect();
    }

    public function db_connect() {
        // $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $this->connection = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        
        if($this->connection->connect_errno){
            die('Database connection failed. ' . $this->connection->connect_error);
        }
    }

    public function query($sql){
        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;
    }

    private function confirm_query($query){
        if(!$query){
            die('Query Failed ' . $this->connection->error());
        }
    }

    public function escape_string($string){
        $escaped_string = $this->connection->real_escape_string($string);
        return $escaped_string;
    }

    public function add_id(){
        return $this->connection->insert_id;
    }
}

$db = new Database;