<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $num1 = 10;
        $num2 = 20;

        echo $num1 + $num2;
        echo "<br>";

        $topRaptors = array('Lowry', 'Siakam', 'Gasol');
        $topRaptorsAssoc = array("PG" => "Lowry", "PF" => "Siakam", "C" => "Gasol");
        print_r($topRaptors);
        echo "<br>";
        print_r($topRaptorsAssoc);
    ?>
</body>
</html>