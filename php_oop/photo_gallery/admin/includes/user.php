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
        $found_user = mysqli_fetch_array($get_user);

        return $found_user;
    }

    public static function submit_query($sql){
        global $db;

        $result = $db->query($sql);

        return $result;
    }

    public static function instantiation($user_data){
        $obj = new self;
        $obj->id = $user_data['user_id'];
        $obj->username = $user_data['username'];
        $obj->password = $user_data['user_password'];
        $obj->first_name = $user_data['user_first_name'];
        $obj->last_name = $user_data['user_last_name'];

        return $obj;
    }  
}