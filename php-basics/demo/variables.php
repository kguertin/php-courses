<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $name = "Kevin";
        $number = 13;

        // Variables are case sensitive
        $NUMBER = 100;

        echo $name;
        echo $number;
        echo $NUMBER;

        // can also user concatenation 
        $best_pg = "Lowry";

        echo "Kyle " . $best_pg;

        // HTML in variables
        $hello = "<h1> Hello</h1>";
        echo $hello;

    ?>
</body>
</html>