<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $number = 60;

        if($number < 10){
            echo "This is less than 10";
        }

        echo "<br>";

        switch($number){
            case 34: 
            echo "is it 34";
            break;
            case 40:
            echo "is it 40";
            break;
            case 4:
            echo "is it 4";
            break;
            case 10:
            echo "is it 10";
            break;

            default : 
            echo "We could not find anything";
            break;
        }
    ?>
</body>
</html>