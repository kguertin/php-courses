<?php

class User extends Db_object{

    protected static $db_table = "users";
    protected static $db_table_fields = array('username', 'password', "first_name", "last_name", "image");
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $image;
    public $upload_dir = "images";
    public $image_placeholder = "http://placehold.it/400x400&text=image";

    public static function verify_user($username, $password){
        global $db;
        
        $username = $db->escape_string($username);
        $password = $db->escape_string($password);

        $sql = "SELECT * FROM " . self::$db_table ." WHERE username = '{$username}' AND password = '{$password}' LIMIT 1 ";
        $get_user = self::submit_query($sql);

        return !empty($get_user) ? array_shift($get_user) : false;
    }

    public function get_image() {
        return empty($this->image) ? $this->image_placeholder : $this->upload_dir.DS.$this->image;
    }

}

