<?php

$file = "example.txt";

if($handle = fopen($file, 'r')){
   echo $content = fread($handle, filesize($file)); //each byte is a chartacter

    fclose($handle);
} else {
    echo "The file could not be written";
}


