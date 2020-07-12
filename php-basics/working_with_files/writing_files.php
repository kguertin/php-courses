<?php

$file = "example.txt";

if($handle = fopen($file, 'w')){
    fwrite($handle, "PHP is cool!");

    fclose($handle);
} else {
    echo "The file could not be written";
}


