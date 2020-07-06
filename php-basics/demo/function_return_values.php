<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Functions and return values</title>
</head>
<body>
    <?php
        function add_nums($num1, $num2){
            $sum = $num1 + $num2;
            return $sum;
        }

       $result = add_nums(3, 3);
       echo "the sum is " . $result . "<br>";

       $result = add_nums(100, $result);
       echo "the sum is now " . $result . "<br>";
    
    ?>
</body>
</html>