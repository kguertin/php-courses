<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Existing PHP functions</title>
</head>
<body>
    <?php

    // PHP math functions
        echo pow(2,7); //Power function
        echo "<br>";
        echo rand(1, 100); // Random number give a range
        echo "<br>";
        echo sqrt(100); // squart root
        echo "<br>";
        echo ceil(2.1); // rounds to next full number
        echo "<br>";
        echo floor(4.9); // rounds down to next integer
        echo "<br>";
        echo round(9.49); // rounds depending on the float value
        echo "<br>"; 

    // PHP string functions
        $string = "Hello World!";
        echo strlen($string); // length of string
        echo "<br>";
        echo strtoupper($string); // to upper case
        echo "<br>";
        echo strtolower($string); // to lower case 
        echo "<br>";

    // PHP Array Functions
        $list = [10, 26, 73, 666, 14, 5, 4, 232];
        echo max($list); // max value in array
        echo "<br>";
        echo min($list); // min value in array
        echo "<br>";
        sort($list); // sory array
        print_r($list); // print recursivly


    
    ?>
</body>
</html>