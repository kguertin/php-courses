<?php
    if(isset($_POST["create_post"])) {
        $post_title = $_POST["post_title"];
        $post_category_id = $_POST["post_category"];
        $post_user = $_POST["post_user"];
        $post_status = $_POST["post_status"];

        $post_image = $_FILES["post_image"]["name"];
        $post_image_temp = $_FILES["post_image"]["tmp_name"]; // this creates a temp location

        $post_tags = $_POST["post_tags"];
        $post_content = $_POST["post_content"];
        $post_date  = date('d-m-y');
        // $post_comment_count = 1;

        move_uploaded_file($post_image_temp, "../images/$post_image"); // Where we save the file

        $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) "; 

        $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' ) ";

        $add_post = mysqli_query($connection, $query);

        confirm_query($add_post);

        $new_post_id = mysqli_insert_id($connection);

        echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$new_post_id}'>View Post</a> or <a href='posts.php?p_id={$new_post_id}'>View All Posts</a></p>" ;
    }

?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title" id="post_title">
    </div>

    <div class="form-group">
    <label for="category">Category</label>
        <select class='form-control' name="post_category" id="category">
            <?php
                $query = "SELECT * FROM categories";
                $get_edit_categories = mysqli_query($connection, $query);

                confirm_query($get_edit_categories);

                while($row = mysqli_fetch_assoc($get_edit_categories)){
                    $cat_id = $row["id"];
                    $cat_title = $row["cat_title"];

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="users">Users</label>
        <select class='form-control' name="post_user" id="users">
            <?php
                $query = "SELECT * FROM users";
                $get_users = mysqli_query($connection, $query);

                confirm_query($get_users);

                while($row = mysqli_fetch_assoc($get_users)){
                    $user_id = $row["user_id"];
                    $username = $row["username"];

                    echo "<option value='{$username}'>{$username}</option>";
                }
            ?>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" id="post_author">
    </div> -->

    <div class="form-group">
    <label for="post_status">Post Status</label>
        <select class='form-control' name="post_status" id="post_status">
            <option value="draft">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" class="form-control" name="post_image" id="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>



</form>