<?php
    echo "This is the query data: " . "<br>";
    print_r($_GET);
    echo "<br>";

    if(isset($_GET["best_pg"])){
        $name = "bestPG";
        $value = $_GET["best_pg"];
        $expiration = time() + (60 * 60 * 24 * 7);
        
        setcookie($name, $value, $expiration);
        
    }

    if(isset($_COOKIE['bestPG'])){
        echo "This is the cookie we set: " . "<br>";
        print_r($_COOKIE['bestPG']);
        echo "<br>";
    }

    session_start();
    
    if(isset($_COOKIE["bestPG"])){
        $_SESSION['cookie'] = $_COOKIE['bestPG'];
    }

    if(isset($_SESSION['cookie'])){
        echo "<br>";
    
        echo "This is the session: " . "<br>";
        print_r($_SESSION);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice Section 9</title>
</head>
<body>
    <?php 
        $best_pg="kyle_lowry"; 
        if(isSet($_GET['best_pg'])){
            $button = "Press for more details";
        } else {
            $button = "Click Here";
        }
    ?>
    <a href="practice_section_9.php?best_pg=<?php echo $best_pg; ?>"><?php echo $button; ?></a>
</body>
</html>