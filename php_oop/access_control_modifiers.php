<?php

class Cars {
    public $wheel_count= 4; // can be user throughout the whole program
    private $door_count = 4; // Only this class
    protected $engine_count = 1; // This class and any subclasses

    function car_details() {
        echo $this->wheel_count;
        echo $this->door_count;
        echo $this->engine_count;
    }

}

$bmw = new Cars();
echo $bmw->wheel_count;
// echo $bmw->door_count;
// echo $bmw->engine_count;

$bmw->car_details();