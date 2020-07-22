<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_users)){
            $user_id = $row["user_id"];
            $username = $row["username"]; 
            $user_password = $row["user_password"];
            $user_first_name = $row["user_first_name"]; 
            $user_last_name = $row["user_last_name"];
            $user_email = $row["user_email"];
            $user_image = $row["user_image"];
            $user_role = $row["user_role"];
            
            echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_first_name}</td>";
            echo "<td>{$user_last_name}</td>";
            echo "<td>{$user_email}</td>";
            echo "<td>{$user_role}</td>";
            echo "<td><a href='#'>Approve</a></td>";      
            echo "<td><a href='#'>Unapprove</a></td>";    
            echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
            echo "</tr>";
            
        }


    ?>
        
    </tbody>
</table>


<?php

    if(isset($_GET["unapprove"])){
        $unapprove_comment_id = $_GET["unapprove"];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '$unapprove_comment_id' ";
        $unapprove_comment_query = mysqli_query($connection, $query);

        confirm_query($unapprove_comment_query);

        header("Location: comments.php");
    }

    if(isset($_GET["approve"])){
        $approve_comment_id = $_GET["approve"];

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '$approve_comment_id' ";
        $approve_comment_query = mysqli_query($connection, $query);

        confirm_query($approve_comment_query);

        header("Location: comments.php");
    }

    if(isset($_GET["delete"])){
        $delete_user_id = $_GET["delete"];

        $query = "DELETE FROM users where user_id = {$delete_user_id} ";
        $delete_query = mysqli_query($connection, $query);

        confirm_query($delete_query);

        header("Location: users.php");
    }
?>