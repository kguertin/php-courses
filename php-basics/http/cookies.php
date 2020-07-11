<?php
   $_COOKIE; // Super Global Assoc array
   
   $name = "cookieName";
   $value = 100;
   $expiration = time() + (60 * 60 * 24 * 7);

   setcookie($name, $value, $expiration); // takes name, value, expiration 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies</title>
</head>
<body>
    <?php
        if(isset($_COOKIE["cookieName"])){  
            $savedCookie = $_COOKIE["cookieName"];
            echo $savedCookie;
        } else {
            $savedCookie = "";
        }

    ?>
</body>
</html>