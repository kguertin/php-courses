<?php
    print_r($_GET); // Prints associative array
    if($_GET['id'] == 10){
        echo "Heck Yes";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HTTP and GET super global</title>
</head>
<body>

    <?php 
        $id=10;
        $button =  "SUBMIT"

    ?>
    <a href="get.php?id=<?php echo $id ?>"><?php echo $button; ?></a>
</body>
</html>