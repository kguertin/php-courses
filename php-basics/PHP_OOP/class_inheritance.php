<?PHP

class Car {

    var $wheels = 4;
    var $hood = 1;
    var $engine = 1;
    var $doors = 1;

    function moveWheels(){
        $this->wheels = 10;
    }  

}

$bmw = new Car();

class Plane extends Car{ //Inherits the props and methods of the car class
    var $engine = 2;
}

if(class_exists("Plane")){
    echo "Plane class exists";
}
echo "<br>";

$jet = new Plane();

echo $jet->wheels;
echo "<br>";
$jet->moveWheels();
echo $jet->wheels;
echo "<br>";
echo $jet->engine;