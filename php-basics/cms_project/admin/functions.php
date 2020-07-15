<?php

function confirm_query($result) { 
    global $connection;
    
    if(!$result){
        die("Query Failed" . mysqli_error($connection));
    }
}

function insert_categories(){
    global $connection;

    if(isset($_POST['submit'])){
        $cat_title = $_POST["cat_title"];
        if($cat_title == "" || empty($cat_title)){
            echo "This field should not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) ";
            $query .= "VALUES('$cat_title')";
            
            $create_category = mysqli_query($connection, $query);
            
            if(!$create_category){
                die('Query Failed' .  mysqli_error($connection));
            }
        }
    }
}

function find_all_categories(){
    global $connection;

    $query = "SELECT * FROM categories";
    $select_catagories = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_catagories)){
        $cat_id = $row["id"];
        $cat_title = $row["cat_title"];
        
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";
    }
}

function delete_category(){
    global $connection;
    
    if(isset($_GET['delete'])){
        $cat_id_delete = $_GET["delete"];
        
    $query = "DELETE FROM categories WHERE id = {$cat_id_delete}";
    
    $delete_query = mysqli_query($connection, $query);

    header("Location: categories.php");
    }
}