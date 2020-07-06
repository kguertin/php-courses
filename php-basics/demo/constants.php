<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constants</title>
</head>
<body>  
    <?php
        $variable =  "this is a variable"; // Declaring a variable.

        define("NAME", "Kevin");

        echo NAME;
        echo "<br>";
        // This will throw and error as we cannot change a constant.
        // NAME = "Larry"
        
        // Another way to make a constant (only scalar data):
        const ANOTHER_NAME = "Larry";
        echo ANOTHER_NAME;
    ?>
</body>
</html>