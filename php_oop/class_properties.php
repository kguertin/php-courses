<?php

class Cars {
    //creating a class property 
    var $wheel_count= 4;
    var $door_count = 4;

    function greeting() {
        return "This car has " .$this->wheel_count . "wheels";
    }

}

$bmw = new Cars();

//Accessing a Class variable and can change on object
echo $bmw->wheel_count . "<br />";
echo $bmw->wheel_count = 10 . "<br />"; //This doesnt change the class
echo $bmw->greeting();
