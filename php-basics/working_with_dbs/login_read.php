<?php
        // mysqli_connect(server, user, password, db)
        $connection = mysqli_connect('localhost', 'root', '', 'loginapp');

        if($connection) {
            echo 'We are connected';
        } else {
            die("Database connection failed.");
        }

        $query = "SELECT * FROM users";

        $result = mysqli_query($connection, $query);

       if(!$result) {
           die('Query Failed' . mysqli_error());
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
            <?php
                // mysqli_fetch_row - returns array
                // mysqli_fetch_assoc - returns assoc array

                while($row = mysqli_fetch_assoc($result)){
                    ?>
                    <pre>
                    <?php
                    print_r($row);
                    ?>
                    </pre>
                    <?php
                }
                ?>
        </div>
    </div>
</body>
</html>