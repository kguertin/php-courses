<?php
    $connection = mysqli_connect('localhost', 'root', '', 'demo');
    if(!$connection){
        die("connection failed");
    }

    if(isset($_POST['submit'])){
        $username = $_POST["username"];
        $email = $_POST["email"];

        $query = "INSERT INTO demo (username, email) ";
        $query .= "VALUES ('$username', '$email')";

        $result = mysqli_query($connection, $query);

        if(!$result){
            echo die('Query Failed');
        }
    }

    $readQuery = "SELECT * FROM demo";
    
    $readResult = mysqli_query($connection, $readQuery);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>practice section 7</title>
</head>
<body>
<h1>Data</h1>
<?php while($row = mysqli_fetch_assoc($readResult)){ ?>
        <h6>
        <?php print_r($row); ?> 
        </h6>
    <?php }; ?>
<form action="practice_section_7.php" method="POST">
<input type="text" name="username" placeholder="username">
<input type="email" name="email" placeholder="email">
<input type="submit" name="submit" value="submit">
</form>
    
</body>
</html>