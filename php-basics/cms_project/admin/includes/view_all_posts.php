<?php
    if(isset($_POST['checkBoxArray'])){
        $bulk_options = $_POST['bulk_options'];
        foreach($_POST['checkBoxArray'] as $post_id){
            switch($bulk_options){
                case 'published':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $post_id";
                    $update_post_status = mysqli_query($connection, $query);
                    confirm_query($update_post_status);
                    break;
                case 'draft':
                    $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = $post_id";
                    $delete_selected_posts = mysqli_query($connection, $query);
                    confirm_query($delete_selected_posts);
                    break;
                case 'delete':
                    $query = "DELETE FROM posts WHERE post_id = $post_id";
                    $update_post_status = mysqli_query($connection, $query);
                    confirm_query($update_post_status);
                    break;
                case 'clone':
                        $query = "SELECT * FROM posts WHERE post_id = $post_id";
                        $get_post_data = mysqli_query($connection, $query);
                        confirm_query($get_post_data);

                        while($row = mysqli_fetch_array($get_post_data)){
                            $post_title = $row["post_title"];
                            $post_category_id = $row["post_category_id"];
                            $post_author = $row["post_author"];
                            $post_status = $row["post_status"];
                            $post_image = $row["post_image"];
                            $post_tags = $row["post_tags"];
                            $post_content = $row["post_content"];
                            $post_date  = $row['post_date'];
                                           
                        }
                        $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                        $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' ) ";

                        $clone_post = mysqli_query($connection, $query);
                
                        confirm_query($clone_post);

                        break;
            }
        }
    }
?>

<form action="" method="POST">
<table class="table table-bordered table-hover">
    <div id="bulkOptionsCOntainer" class="col-xs-4" id="bulkOptionsContainer">
        <select class='form-control' name="bulk_options" id=''>
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
        </select>
    </div>
    <div class="col-xs-4">
        <input type="submit" name="submit" class="btn btn-success" value='Apply'>
        <a class='btn btn-primary' href="posts.php?source=add_post">Add New</a>
    </div>

    <thead>
        <tr>
            <th><input id="selectAllBoxes" type="checkbox"></th>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Views</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View Post</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * FROM posts ORDER BY post_id DESC";
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
            $post_views = $row["post_views"];
            
            echo "<tr>";
            ?>

            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>;
            
            <?php
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
            echo "<td><a href='posts.php?reset={$post_id}'>{$post_views}</a></td>";
            echo "<td>{$post_tags}</td>";

            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $send_comment_query = mysqli_query($connection, $query);
            $count_comments = mysqli_num_rows($send_comment_query);
            echo "<td>{$count_comments}</td>";

            echo "<td>{$post_date}</td>";
            echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>"; 
            echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";   
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }


    ?>
        
    </tbody>
</table>
</form>


<?php
    if(isset($_GET["delete"])){
        $delete_post_id = $_GET["delete"];

        $query = "DELETE FROM posts WHERE post_id = {$delete_post_id} ";
        $delete_query = mysqli_query($connection, $query);

        confirm_query($delete_query);

        header("Location: posts.php");
    }

    if(isset($_GET["reset"])){
        $reset_post_id = $_GET["reset"];

        $query = "UPDATE posts SET post_views = 0 WHERE post_id = " . mysqli_real_escape_string($connection, $reset_post_id) ." ";
        $reset_query = mysqli_query($connection, $query);

        confirm_query($reset_query);

        header("Location: posts.php");
    }

?>