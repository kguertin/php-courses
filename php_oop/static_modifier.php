<?php
// can make a method or property. static property attaches to the class not instance.
class Cars {
    public $wheel_count= 4; 
    static $door_count = 4;

   static function car_details() {
        echo Cars::$door_count;
    }

}

$bmw = new Cars();
echo $bmw->wheel_count;
// echo $bmw->door_count; // This cant access static property

echo Cars::$door_count; // calling static methods and properties.
echo Cars::car_details();