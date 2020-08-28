<?php

class User extends Db_object{

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'user_password', "user_first_name", "user_last_name");
    public $id;
    public $username;
    public $user_password;
    public $user_first_name;
    public $user_last_name;

    public static function verify_user($username, $password){
        global $db;
        
        $username = $db->escape_string($username);
        $password = $db->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table ." WHERE username = '{$username}' AND user_password = '{$password}' LIMIT 1 ";
        $get_user = self::submit_query($sql);

        return !empty($get_user) ? array_shift($get_user) : false;
    }

}

