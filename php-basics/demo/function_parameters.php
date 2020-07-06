<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Parameters</title>
</head>
<body>
    <?php
    
        function greeting($name){
            echo "Hello $name" . "<br>";
        }

        greeting("Kevin");

        // Can pass defaults like this? it works 
        function add_nums($num1 = 3, $num2 = 10){
            echo $num1 + $num2;
        }

        add_nums(5, 1);
        echo "<br>";
        add_nums(); // adds defaults;
    
    ?>
</body>
</html>