<form action="" method="POST">
<table class="table table-bordered table-hover">
    <div id="bulkOptionsCOntainer" class="col-xs-4">
        <select class='form-control' name="" id="">
            <option value="">Select Options</option>
            <option value="">Publish</option>
            <option value="">Draft</option>
            <option value="">Delete</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value='Apply'>
        <a class='btn btn-primary' href="add_post.php">Add New</a>
    </div>

    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_posts)){
            $post_id = $row["post_id"];
            $post_author = $row["post_author"];
            $post_title = $row["post_title"];
            $post_category_id = $row["post_category_id"];
            $post_status = $row["post_status"];
            $post_image = $row["post_image"];
            $post_date = $row["post_date"];
            $post_tags = $row["post_tags"];
            $post_comment_count = $row["post_comment_count"];
            
            echo "<tr>";
            echo "<td>{$post_id}</td>";
            echo "<td>{$post_author}</td>";
            echo "<td>{$post_title}</td>";

            // Get category title matching category id 
            $query = "SELECT * FROM categories WHERE id = $post_category_id";
            $select_category_id = mysqli_query($connection, $query);
      
            $category_result = mysqli_fetch_assoc($select_category_id);
            $cat_title = $category_result["cat_title"];

            echo "<td>{$cat_title}</td>";
            echo "<td>{$post_status}</td>";
            echo "<td><img width='100' src='../images/$post_image' alt='Post Image'></td>";
            echo "<td>{$post_tags}</td>";
            echo "<td>{$post_comment_count}</td>";
            echo "<td>{$post_date}</td>";
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";      
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
            
            echo "</tr>";
        }


    ?>
        
    </tbody>
</table>
</form>


<?php
    if(isset($_GET["delete"])){
        $delete_post_id = $_GET["delete"];

        $query = "DELETE FROM posts where post_id = {$delete_post_id} ";
        $delete_query = mysqli_query($connection, $query);

        confirm_query($delete_query);

        header("Location: posts.php");
    }
?>