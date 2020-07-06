<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(4 <= 4 ){
            echo 'It is true';
        }
        
        if (1 === "1") {
            echo "both one";
        } else {
            echo "one is a string";
        }

        if(4 != 4 || 5 > 1){
            echo "one was true";
        }

        if (4 > 1 && 5 < 10){
            echo 'both are true';
        } else {
            echo 'one is false';
        }
    ?>
</body>
</html>