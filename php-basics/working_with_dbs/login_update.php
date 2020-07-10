<?php include "db.php"; ?>
<?php include "functions.php"; ?>

<?php
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $id = $_POST['id'];
        
        $query = "UPDATE users SET ";
        $query .= "username = '$username', ";
        $query .= "password = '$password' ";
        $query .= "WHERE id = $id ";

        $result = mysqli_query($connection, $query);
        if(!$result){
            die('Query Failed' . mysqli_error($connection));
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
            <form action="login_update.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="form-group">
                    <select name="id" id="">
                        <?php
                        showAllData();
                        ?>
                    </select>
                </div>
                <input class="btn btn-primary" type="submit" name="submit" value="Update">
            </form>
        </div>
    </div>
</body>
</html>