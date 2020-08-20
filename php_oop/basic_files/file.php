<?php
    //magic constants 

    echo __FILE__ . "<br />";
    echo __LINE__ . "<br />";
    echo __DIR__ . "<br />";

    if(file_exists(__DIR__)){
        echo 'YESSSSSS' . "<br />";
    }

    if(is_file(__DIR__)){
        echo 'YESSSSSS' . "<br />";
    } else {
        echo "NOOOOOOOOOOOOO" . "<br />";
    }

    if(is_file(__FILE__)){
        echo 'YESSSSSS' . "<br />";
    } else {
        echo "NOOOOOOOOOOOOO" . "<br />";
    }

    if(is_dir(__FILE__)){
        echo 'YESSSSSS' . "<br />";
    } else {
        echo "NOOOOOOOOOOOOO" . "<br />";
    }

    echo file_exists(__FILE__) ? "yes" : "no";


?>