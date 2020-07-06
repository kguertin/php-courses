<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice Section 4</title>
</head>
<body>
    <?php

        function divide_nums(){
            $result = 10 / 5;
            return $result;
        }

        echo divide_nums();
        echo "<br>";

        function best_pg($name1 = "Kyle Lowry", $name2 = "anyone else"){
            return "$name1 is a better point guard than $name2" . ".";
        }

        echo best_pg("Kyle Lowry", "Chris Paul");
        echo "<br>";
        echo best_pg();
    ?>

</body>
</html>