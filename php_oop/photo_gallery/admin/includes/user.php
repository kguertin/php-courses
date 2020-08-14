<?php

class User {

    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;


    public static function find_all_users(){   
        return self::submit_query("SELECT * FROM users");
    }

    public static function find_user_by_id($id){
        global $db;

        $get_user = self::submit_query("SELECT * FROM users WHERE user_id = {$id} LIMIT 1");

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
}