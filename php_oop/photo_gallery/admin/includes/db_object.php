<?php

class Db_object {
    protected static $db_table;
    protected static $db_table_fields;


    public $errors = array();
    public $upload_error_arr = array(
        UPLOAD_ERR_OK => "There is no error.",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive.",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive",
        UPLOAD_ERR_PARTIAL => "The file was only uploaded partialy.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension  stopped the file upload.",
    );

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

    protected function properties() {
        $properties = array();

        foreach(static::$db_table_fields as $db_field){
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
        
        $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ") ";
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
        
        $sql = "UPDATE " . static::$db_table . " SET ";
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
        
        $sql = "DELETE FROM " . static::$db_table . " WHERE id = " . $db->escape_string($this->id) . " LIMIT 1";
        $db->query($sql);
        return (mysqli_affected_rows($db->connection) == 1) ? true : false; 
    }
}