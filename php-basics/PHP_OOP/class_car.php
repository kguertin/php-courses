<?PHP

class Car {
    function moveWheels(){
        echo "Wheels Move";
    }    
}

if(method_exists("Car", "moveWheels")){
    echo "the method exists";
}



?>