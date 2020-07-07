
<?php
// super global variable is associative array

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    echo "username: ". $username . " Password: " . $password;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Working With Form Data</title>
</head>
<body>
    <form action="form.php" method="POST">
        <input type="text" name="username" placeholder="Enter Username">
        <input type="password" name="password" placeholder="Enter Password"><br>
        <input type="submit" name="submit">
    </form>
</body>
</html>