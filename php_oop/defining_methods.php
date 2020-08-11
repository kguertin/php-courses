<?php

class Cars {
    //Defining methods
    function greeting() {
    }

    function goodbye() {

    }
}

$methods = get_class_methods('Cars');

foreach($methods as $method){
    echo $method . "<br />";
}
    