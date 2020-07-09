<?php
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        // mysqli_connect(server, user, password, db)
        $connection = mysqli_connect('localhost', 'root', '', 'loginapp');

        if($connection) {
            echo 'We are connected';
        } else {
            die("Database connection failed.");
        }

        $query = "INSERT INTO users(username,password)";
        $query .= "VALUES ('$username', '$password')";

       $result = mysqli_query($connection, $query);

       if(!$result) {
           die('Query Failed' . mysqli_error());
       }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Working with DBs - create</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="col-sm-6">
            <form action="login_create.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>