<?php

class User {

    public $user_id;
    public $username;
    public $user_password;
    public $user_first_name;
    public $user_last_name;


    public static function find_all_users(){   
        return self::submit_query("SELECT * FROM users");
    }

    public static function find_user_by_id($user_id){
        global $db;

        $get_user = self::submit_query("SELECT * FROM users WHERE user_id = {$user_id} LIMIT 1");

        return !empty($get_user) ? array_shift($get_user) : false;
    }

    public static function submit_query($sql){
        global $db;

        $result = $db->query($sql);

        $obj_array = array();

        while($row = mysqli_fetch_array($result)){
            $obj_array[] = self::instantiation($row);
        }
        return $obj_array;
    }

    public static function verify_user($username, $password){
        global $db;
        
        $username = $db->escape_string($username);
        $password = $db->escape_string($password);

        $sql = "SELECT * FROM users WHERE username = '{$username}' AND user_password = '{$password}' LIMIT 1 ";
        $get_user = self::submit_query($sql);

        return !empty($get_user) ? array_shift($get_user) : false;
    }

    public static function instantiation($user_data){
        $obj = new self;

        foreach($user_data as $attribute => $value){
            if($obj->has_attribute($attribute)){
                $obj->$attribute = $value;
            };
        }

        return $obj;
    } 
    
    private function has_attribute($attribute){
        $obj_properties = get_object_vars($this);
        return array_key_exists($attribute, $obj_properties);
    }

    public function save() {
        return isset($this->user_id) ? $this->update() : $this->create();
    }

    public function create() {
        global $db;

        $sql = "INSERT INTO users (username, user_password, user_first_name, user_last_name) ";
        $sql .= "VALUES('";
        $sql .= $db->escape_string($this->username) . "', '";
        $sql .= $db->escape_string($this->user_password) . "', '";
        $sql .= $db->escape_string($this->user_first_name) . "', '";
        $sql .= $db->escape_string($this->user_last_name) . "')";

        if($db->query($sql)){
            $this->user_id = $db->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update(){
        global $db;

        $sql = "UPDATE users SET ";
        $sql .= "username = '" . $db->escape_string($this->username) . "', ";
        $sql .= "user_password = '" . $db->escape_string($this->user_password) . "', ";
        $sql .= "user_first_name = '" . $db->escape_string($this->user_first_name) . "', ";
        $sql .= "user_last_name = '" . $db->escape_string($this->user_last_name) . "' ";
        $sql .= "WHERE user_id= " . $db->escape_string($this->user_id);

        $db->query($sql);

        return (mysqli_affected_rows($db->connection) == 1) ? true : false; 

    }

    public function delete() {
        global $db;

        $sql = "DELETE FROM users WHERE user_id = " . $db->escape_string($this->user_id) . " LIMIT 1";
        $db->query($sql);
        return (mysqli_affected_rows($db->connection) == 1) ? true : false; 
    }

}

