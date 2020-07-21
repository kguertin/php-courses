<?php
    if(isset($_POST["create_post"])) {
        $post_title = $_POST["post_title"];
        $post_category_id = $_POST["post_category"];
        $post_author = $_POST["post_author"];
        $post_status = $_POST["post_status"];

        $post_image = $_FILES["post_image"]["name"];
        $post_image_temp = $_FILES["post_image"]["tmp_name"]; // this creates a temp location

        $post_tags = $_POST["post_tags"];
        $post_content = $_POST["post_content"];
        $post_date  = date('d-m-y');
        // $post_comment_count = 1;

        move_uploaded_file($post_image_temp, "../images/$post_image"); // Where we save the file

        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) "; 

        $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' ) ";

        $add_post = mysqli_query($connection, $query);

        confirm_query($add_post);
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
        <select name="post_category" id="">
            <?php
                $query = "SELECT * FROM users";
                $get_users = mysqli_query($connection, $query);

                confirm_query($get_users);

                while($row = mysqli_fetch_assoc($get_users)){
                    $user_id = $row["user_id"];
                    $user_role = $row["user_role"];

                    echo "<option value='{$user_id}'>{$user_role}</option>";
                }
            ?>
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