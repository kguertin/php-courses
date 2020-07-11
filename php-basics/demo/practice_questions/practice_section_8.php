<?php
    $pg = "Kyle Lowry";

    $hash_format = "$2y$10$";
    $salt = "iusesomecrazystrings22";
    $hashF_and_salt = $hash_format . $salt;

    $pg = crypt($pg, $hashF_and_salt);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice Questions 8</title>
</head>
<body>
  <h1><?php echo $pg; ?></h1>  
</body>
</html>