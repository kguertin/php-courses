<?php
// Defining a class in PHP
class Cars {
    function greeting() {
    }

    function goodbye() {
        
    }
}

$methods = get_class_methods('Cars');

foreach($methods as $method){
    echo $method . "<br />";
}
    