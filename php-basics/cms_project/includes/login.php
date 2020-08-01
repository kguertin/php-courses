<?php include "db.php" ?>

<?php
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cleans data and protects against sql injection
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);

    if(!$select_user_query) {
        die("Query failed" . mysqli_error($connection));
    }

    $query_user_table = mysqli_fetch_array($select_user_query);
    $db_id = $query_user_table['user_id'];
    $db_first_name = $query_user_table['user_first_name'];
    $db_last_name = $query_user_table['user_last_name'];
    $db_role = $query_user_table['user_role'];
    $db_username = $query_user_table['username'];
    $db_password = $query_user_table['user_password'];


    if($username !== $db_username && $password !== $db_password){
        header("Location: ../index.php");
    } else if ($username == $db_username && $password == $db_password) {
        header("Location: ../admin"); 
    } else {
        header("Location: ../index.php");
    }
}
?>