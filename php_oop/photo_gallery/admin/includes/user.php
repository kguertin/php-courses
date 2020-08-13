<?php

class User {


    public static function find_all_users(){
        global $db;
        $get_users = $db->query("SELECT * FROM users");
        return $get_users;
    }

    public static function find_user_by_id($id){
        global $db;
        $get_user = $db->query("SELECT * FROM users WHERE user_id = {$id}");
        $found_user = mysqli_fetch_array($get_user);
        return $found_user;
    }
}