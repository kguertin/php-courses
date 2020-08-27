<?php

class User {

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'user_password', "user_first_name", "user_last_name");
    public $id;
    public $username;
    public $user_password;
    public $user_first_name;
    public $user_last_name;


    public static function find_all_users(){   
        return self::submit_query("SELECT * FROM users");
    }

    public static function find_user_by_id($id){
        global $db;

        $get_user = self::submit_query("SELECT * FROM users WHERE id = {$id} LIMIT 1");

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

    protected function properties() {
        $properties = array();

        foreach(self::$db_table_fields as $db_field){
            if(property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function escaped_properties() {
        global $db;

        $escaped_properties = array();

        foreach($this->properties() as $key => $value){
            $escaped_properties[$key] =  $db->escape_string($value);
        }

        return $escaped_properties;
    }

    
    public function create() {
        global $db;

        $properties = $this->escaped_properties();
        
        $sql = "INSERT INTO " . self::$db_table . " (" . implode(",", array_keys($properties)) . ") ";
        $sql .= "VALUES('" . implode("','", array_values($properties)) . "')";
        
        if($db->query($sql)){
            $this->id = $db->insert_id();
            return true;
        } else {
            return false;
        }
    }
    
    public function update(){
        global $db;
        $properties = $this->escaped_properties();
        $key_and_value = array();

        foreach($properties as $key => $value){
            $key_and_value[] = "{$key}='{$value}'";
        }
        
        $sql = "UPDATE " . self::$db_table . " SET ";
        $sql .= implode(', ', $key_and_value);
        $sql .= "WHERE id= " . $db->escape_string($this->id);
        
        $db->query($sql);
        
        return (mysqli_affected_rows($db->connection) == 1) ? true : false; 
        
    }
    
    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function delete() {
        global $db;
        
        $sql = "DELETE FROM " . self::$db_table . " WHERE id = " . $db->escape_string($this->id) . " LIMIT 1";
        $db->query($sql);
        return (mysqli_affected_rows($db->connection) == 1) ? true : false; 
    }

}

