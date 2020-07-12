<?PHP

class Car {

    public $wheels = 4;
    protected $hood = 1;
    private $engine = 1;
    var $doors = 1;

    function showProperty(){
        echo $this->engine;
    }  

}

$bmw = new Car();

echo $bmw->wheels;
echo $bmw->showProperty(); // being used within class

class Semi extends Car {

}

$semi = new Semi();
echo $semi->showProperty();
