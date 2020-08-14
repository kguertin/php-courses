<?php
    if(isset($_GET['p_id'])){
        $post_id_edit = $_GET['p_id'];
    }
    $query = "SELECT * FROM posts WHERE post_id = {$post_id_edit}";
    $select_posts = mysqli_query($connection, $query);
    $post_data = mysqli_fetch_assoc($select_posts);

    $post_title = $post_data["post_title"];
    $post_category_id = $post_data["post_category_id"];
    $post_user = $post_data["post_user"];
    $post_status = $post_data["post_status"];
    $post_tags = $post_data["post_tags"];
    $post_content = $post_data["post_content"];

    if(isset($_POST['update_post'])){
        $post_title = $_POST["post_title"];
        $post_category_id = $_POST["post_category"];
        $post_user = $_POST["post_user"];
        $post_status = $_POST["post_status"];

        $post_image = $_FILES["post_image"]["name"];
        $post_image_temp = $_FILES["post_image"]["tmp_name"]; // this creates a temp location

        $post_tags = $_POST["post_tags"];
        $post_content = $_POST["post_content"];
        $post_date  = date('d-m-y');

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)) {
            $query = "SELECT post_image FROM posts WHERE post_id = $post_id_edit ";
            $select_image = mysqli_query($connection, $query);

            confirm_query($select_image);

            $result = mysqli_fetch_assoc($select_image);
            $post_image = $result["post_image"];
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_user = '{$post_user}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_tags = '{$post_tags}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$post_id_edit} ";

        $update_post = mysqli_query($connection, $query);
        
        confirm_query($update_post);

        echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$post_id_edit}'>View Post</a> or <a href='posts.php?p_id={$post_id_edit}'>View All Posts</a></p>" ;

    }
?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title" id="post_title">
    </div>

    <div class="form-group">
    <label for="category">Category</label>
        <select class="form-control" name="post_category" id="category">
            <?php
                $query = "SELECT * FROM categories";
                $get_edit_categories = mysqli_query($connection, $query);

                confirm_query($get_edit_categories);

                while($row = mysqli_fetch_assoc($get_edit_categories)){
                    $cat_id = $row["id"];
                    $cat_title = $row["cat_title"];

                    if($cat_id === $post_category_id){
                        echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
                    } else {
                        echo "<option value='{$cat_id}'>{$cat_title}</option>";
                    }

                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="users">Users</label>
        <select class='form-control' name="post_user" id="users">
        <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?>
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

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status" id="post_status">
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="Post Image">
        <input type="file" class="form-control" name="post_image" id="post_image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags" id="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </script>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
    </div>



</form>