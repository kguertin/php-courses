<?php

class Dog {
    public $fur = "black";
    public $snoot = "booped";
    public $pupper = "false" ;

    function ShowAll(){
        echo "Fur: " . $this->fur;
        echo "<br>";
        echo "Snoot status: " . $this->snoot;
        echo "<br>";
        echo "A Pupper? " . $this->pupper;
    }
}

$doggo = new Dog();
$doggo->ShowAll();
echo "<br>";

class Pupper extends Dog {
    public $pupper = "true";
}

$pupper = new Pupper();
$pupper->ShowAll();
