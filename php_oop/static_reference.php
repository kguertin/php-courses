<?php
class Cars {
    static $door_count = 4;

   static function car_details() {
        return self::$door_count;
    }

}

class Trucks extends Cars {
    static function display() {
        echo parent::car_details(); //accessing static property and methods of parent class
    }
}

Trucks::display();