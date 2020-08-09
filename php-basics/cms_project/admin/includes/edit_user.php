<?php

    if(isset($_GET['edit_user'])){
        $edit_user_id = $_GET['edit_user'];

        $query = "SELECT * FROM users WHERE user_id = $edit_user_id";
        $select_users_query = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_users_query)){
            $user_id = $row["user_id"];
            $username = $row["username"]; 
            $user_password = $row["user_password"];
            $user_first_name = $row["user_first_name"]; 
            $user_last_name = $row["user_last_name"];
            $user_email = $row["user_email"];
            $user_image = $row["user_image"];
            $user_role = $row["user_role"];
        }
    }

    if(isset($_POST["edit_user"])) {
        $user_first_name = $_POST["user_first_name"];
        $user_last_name = $_POST["user_last_name"];
        $user_role = $_POST["user_role"];
        $user_email = $_POST["user_email"];
        $username = $_POST["username"];
        $user_password = $_POST["user_password"];

        if(!empty($user_password)){
            $query_password = "SELECT user_password FROM users WHERE user_id = $user_id ";
            $get_user_password = mysqli_query($connection, $query);
            confirm_query($get_user_password);

            $result = mysqli_fetch_array($get_user_password);

            $db_user_password = $result['user_password'];

            if($db_user_password != $user_password){
                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
            }
    
            $query = "UPDATE users SET ";
            $query .= "user_first_name = '{$user_first_name}', ";
            $query .= "user_last_name = '{$user_last_name}', ";
            $query .= "user_role= '{$user_role}', "; 
            $query .= "username = '{$username}', ";
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_password = '{$hashed_password}' ";
            $query .= "WHERE user_id = {$edit_user_id} ";
    
            $update_user = mysqli_query($connection, $query);
            
            confirm_query($update_user);
            header("Location: users.php");
        }
    
    }

?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_first_name">First Name</label>
        <input type="text" class="form-control" value="<?php echo $user_first_name ?>" name="user_first_name" id="user_first_name">
    </div>

    <div class="form-group">
        <label for="user_last_name">Last Name</label>
        <input type="text" class="form-control" value="<?php echo $user_last_name ?>" name="user_last_name" id="user_last_name">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
        <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
        <?php
            if($user_role == 'admin'){
                echo "<option value='subscriber'>subscriber</option>";

            } else {
                echo "<option value='admin'>admin</option>";
            }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $username ?>" class="form-control" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="user_email">email</label>
        <input type="email" class="form-control" value="<?php echo $user_email ?>" name="user_email" id="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" value="<?php echo $user_password ?>" name="user_password" id="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>



</form>