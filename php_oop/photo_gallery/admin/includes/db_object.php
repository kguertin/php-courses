<?php

class Db_object {
    protected static $db_table;

    public static function find_all(){   
        return static::submit_query("SELECT * FROM " . static::$db_table . " ");
    }

    public static function find_by_id($id){
        global $db;

        $get_user = static::submit_query("SELECT * FROM " . static::$db_table . " WHERE id = {$id} LIMIT 1");

        return !empty($get_user) ? array_shift($get_user) : false;
    }

    public static function submit_query($sql){
        global $db;

        $result = $db->query($sql);

        $obj_array = array();

        while($row = mysqli_fetch_array($result)){
            $obj_array[] = static::instantiation($row);
        }
        return $obj_array;
    }

    public static function instantiation($user_data){
        $calling_class = get_called_class(); 
        $obj = new $calling_class;

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