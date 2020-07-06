<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scope</title>
</head>
<body>
    <?php
        $x = "outside"; //Global

        function convert(){
            global $x; // Now has access to global variable;
            $x = "inside"; //local
        } 

        echo $x . "<br>";
        convert();
        echo $x;
    ?>
</body>
</html>