<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $numberList = array(4, 3, 2, 1, 'Zero', true);

        // Different Syntax
        $anotherNumberList = [1, 2, 3, 4];
        
        //can select index with like JS
        echo $numberList[4]; 
        echo "<br>";

        // Print recursivly
        print_r($anotherNumberList);
    ?>
</body>
</html>