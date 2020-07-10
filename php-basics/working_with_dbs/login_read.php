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

<?php include "includes/header.php"; ?>

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
        
<?php include "includes/footer.php"; ?>