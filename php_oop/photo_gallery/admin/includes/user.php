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
    public $upload_directory = "images";
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
        return empty($this->image) ? $this->image_placeholder : $this->upload_directory.DS.$this->image;
    }

    public function set_file($file){

        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded.";
            return false;
        } else if($file['error'] != 0 ){
            $this->errors[] = $this->upload_error_arr[$file['error']];
            return false;
        } else {
            $this->image = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

     public function save_user(){
        if(!empty($this->errors)){
            return false;
        }

        if(empty($this->image) || empty($this->tmp_path)){
            $this->errors[] = "The file was not available";
            return false;
        }

        $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->image;

        if(file_exists($target_path)){
            $this->errors[] = "The file {$this->image} already exists";
            return false;
        }

        if(move_uploaded_file($this->tmp_path, $target_path)){
            if($this->create()){
                unset($this->tmp_path);
                return true;
            }
        } else {
            $this->errors[] = "The file directory may not have the right permissions";
            return false;
        }
    }

}

