<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //runs if ondition is true
        if(3 < 10){
            echo "Three is less than ten";
        }
        
        echo "<br>";

        if(3 > 10){
            echo "Three is more than Ten";
        } elseif(4 < 5) {
            echo "Four is less than five";
        } else {
            echo "Three is still less than ten";
        }
    ?>
</body>
</html>