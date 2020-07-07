
<?php
// super global variable is associative array

if(isset($_POST["submit"])) {
    $names = ['kevin', 'peter', 'george', 'maria', 'jane'];
    $minimum = 5;
    $maximum = 15;

    $username = $_POST["username"];
    $password = $_POST["password"];

    // Form Validation and need to sanatize data submitted 
    if(strlen($username) < $minimum){ // gives string length
        echo 'Username has to be five or more characters.' . "<br>";
    }

    if(strlen($username) > $maximum){
        echo "username cannot be longer than Fifteen characters." . "<br>";
    }

    if(!in_array($username, $names)){ //returns true or false 
        echo "Sorry, you are not allowed!" . "<br>";
    } else {
        echo "Welcome!" . "<br>";
    }

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