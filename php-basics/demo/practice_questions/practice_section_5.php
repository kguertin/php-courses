<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice Section 5</title>
</head>
<body>
    <?php

        echo ceil(1.345623542342346678783);
        echo "<br>";
        $string = "Hello World!";
        echo crypt($string, 10); // second value is number of salts like node crypto
        echo "<br>";
        $list = ['never', 'eat', 'shredded', 'wheat'];
        print_r($list);
        echo "<br>";
        array_pop($list);
        print_r($list);
        echo "<br>";
        array_push($list, 'feets');
        print_r($list);
        echo "<br>";
        echo in_array('feets', $list);

    ?>
</body>
</html>