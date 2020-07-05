<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        // regular array
        $numbers = array(10, 20, 30);
        print_r($numbers);
        echo "<br>";
        echo $numbers[1] . "<br>";

        // Associative Arrays - cna rename array keys(index)
        $names = array("first_name" => "Kevin", "last_name" => 'Guertin');
        print_r($names);
        echo "<br>";
        echo $names["first_name"] . " " . $names["last_name"];

    ?>
</body>
</html>