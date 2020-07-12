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
 // this is like dot notation;
echo "<br>";

echo "Wheels: " . $bmw->wheels;

$bmw->wheels = 8;
echo "<br>";
echo "Wheels: " . $bmw->wheels;

$bmw->moveWheels();
echo "<br>";
echo "Wheels: " . $bmw->wheels;

$truck = new Car();
echo "<br>";
echo "Truck Wheels: " . $truck->wheels = 18;

