<?php
    if(isset($_GET['pid'])){
        $post_id_edit = $_GET['pid'];
    }
    $query = "SELECT * FROM posts";
    $select_posts = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($select_posts)){
        $post_id = $row["post_id"];
        $post_author = $row["post_author"];
        $post_title = $row["post_title"];
        $post_category_id = $row["post_category_id"];
        $post_status = $row["post_status"];
        $post_image = $row["post_image"];
        $post_content = $row["post_content"];
        $post_date = $row["post_date"];
        $post_tags = $row["post_tags"];
        $post_comment_count = $row["post_comment_count"];

    }
?>


<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="post_title" id="post_title">
    </div>

    <div class="form-group">
        <select name="" id="">
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
        <label for="post_author">Post Author</label>
        <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="post_author" id="post_author">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status" id="post_status">
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="Post Image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags" id="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Publish Post">
    </div>



</form>