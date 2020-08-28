<?php

class Photo extends Db_object {
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

    public $custom_err = array();
    public $upload_error_arr = array(
        UPLOAD_ERR_OK => "There is no error.",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive.",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive",
        UPLOAD_ERR_PARTIAL => "The file was only uploaded partialy.",
        UPLOAD_ERR_NO_FILE => "No file was uploaded.",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
        UPLOAD_ERR_EXTENSION => "A PHP extension  stopped the file upload."
    );

    
}