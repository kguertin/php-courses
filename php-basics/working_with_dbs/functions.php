<?php include "db.php"; ?>
<?php

function createRows(){
    if(isset($_POST['submit'])){
        global $connection;

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "INSERT INTO users(username,password)";
        $query .= "VALUES ('$username', '$password')";

       $result = mysqli_query($connection, $query);

       if(!$result) {
           die('Query Failed' . mysqli_error());
       } else {
           echo "Record Created";
       }

    }
}

function readRows(){
    global $connection;

    $query = "SELECT * FROM users";

    $result = mysqli_query($connection, $query);

   if(!$result) {
       die('Query Failed' . mysqli_error());
   }

   // mysqli_fetch_row - returns array
   // mysqli_fetch_assoc - returns assoc array

   while($row = mysqli_fetch_assoc($result)){
        print_r($row);
    }
}

function showAllData() {
    global $connection; // this points to global connection variable, not local scope.

    $query = "SELECT * FROM users";

    $result = mysqli_query($connection, $query);

    if(!$result) {
    die('Query Failed' . mysqli_error());
    }

    while($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        echo "<option value='$id'>$id</option>";
    }
}

function updateTable() {
    if(isset($_POST['submit'])){
        global $connection;
        
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
        } else {
            echo "Record Updated";
        }
    }
}

function deleteRows() {
    if(isset($_POST['submit'])){
        global $connection;
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        $id = $_POST['id'];
        
        $query = "DELETE FROM users ";
        $query .= "WHERE id = $id ";

        $result = mysqli_query($connection, $query);
        if(!$result){
            die('Query Failed' . mysqli_error($connection));
        } else {
            echo "Record Deleted";
        }
    }
}