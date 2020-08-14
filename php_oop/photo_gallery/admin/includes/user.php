<?php

class User {


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
}