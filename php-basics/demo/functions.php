<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions</title>
</head>
<body>
    <?php

        function say_something(){
            echo "Hello World!";
            echo "<br>";
            calculate();
        }

        say_something();
        echo "<br>";
        say_something();

        //I guess these are hoisted? can declare a function below where it is declared.
        function calculate(){
            echo 1 + 1;
        }


    ?>
</body>
</html>