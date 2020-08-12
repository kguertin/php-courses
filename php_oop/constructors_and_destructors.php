<?php
class Cars {
    public $wheel_count = 4;
    static $door_count = 2;

    function __construct() {
        echo $this->wheel_count; //called when you instantiate the class 
        echo self::$door_count++;
    } // Destruct is the same in reverse 

    
}

$bmw = new Cars; 
$ford = new Cars;
