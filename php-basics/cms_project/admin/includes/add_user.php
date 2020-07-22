<?php
    if(isset($_POST["create_user"])) {
        $user_first_name = $_POST["user_first_name"];
        $user_last_name = $_POST["user_last_name"];
        $user_role = $_POST["user_role"];

        // $post_image = $_FILES["post_image"]["name"];
        // $post_image_temp = $_FILES["post_image"]["tmp_name"]; // this creates a temp location

        $user_email = $_POST["user_email"];
        $username = $_POST["username"];
        $user_password = $_POST["user_password"];

        // move_uploaded_file($post_image_temp, "../images/$post_image"); // Where we save the file

        $query = "INSERT INTO users(user_first_name, user_last_name, user_role, username, user_email, user_password) "; 

        $query .= "VALUES ('{$user_first_name}', '{$user_last_name}', '{$user_role}', '{$user_email}', '{$username}', '{$user_password}' ) ";

        $add_user = mysqli_query($connection, $query);

        confirm_query($add_user);

        header("Location: users.php");
    }

?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_first_name">First Name</label>
        <input type="text" class="form-control" name="user_first_name" id="user_first_name">
    </div>

    <div class="form-group">
        <label for="user_last_name">Last Name</label>
        <input type="text" class="form-control" name="user_last_name" id="user_last_name">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="user_email">email</label>
        <input type="email" class="form-control" name="user_email" id="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" id="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User">
    </div>



</form>