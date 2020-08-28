<?php

class Photo extends Db_object
{
    protected static $db_table = "photos";
    protected static $db_table_fields = array('title', 'description', "file_name", "type", "size");
    public $id;
    public $title;
    public $description;
    public $file_name;
    public $type;
    public $size;

    public $tmp_path;
    public $upload_directory = "images";

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

    public function set_file($file){

        if(empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded.";
            return false;
        } else if($file['error'] != 0 ){
            $this->errors[] = $this->upload_error_arr[$file['error']];
            return false;
        } else {
            $this->file_name = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function save(){
        if($this->id){
            $this->update();
        } else {
            if(!empty($this->errors)){
                return false;
            }

            if(empty($this->file_name) || empty($this->tmp_path)){
                $this->errors[] = "The file was not available";
                return false;
            }

            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->file_name;

            $this->create();
        }
    }
}
