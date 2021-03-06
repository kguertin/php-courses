<?php
    include('delete_modal.php');

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
                            $post_user = $row["post_user"];
                            $post_status = $row["post_status"];
                            $post_image = $row["post_image"];
                            $post_tags = $row["post_tags"];
                            $post_content = $row["post_content"];
                            $post_date  = $row['post_date'];
                                           
                        }
                        $query = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
                        $query .= "VALUES ({$post_category_id}, '{$post_title}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' ) ";

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
            <th>User</th>
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
        $query = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";
        $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views, categories.id, categories.cat_title ";
        $query .= "FROM posts ";
        $query .= "LEFT JOIN categories ON posts.post_category_id = categories.id ORDER BY posts.post_id DESC";
        $select_posts = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_posts)){
            $post_id = $row["post_id"];
            $post_author = $row["post_author"];
            $post_user = $row['post_user'];
            $post_title = $row["post_title"];
            $post_category_id = $row["post_category_id"];
            $post_status = $row["post_status"];
            $post_image = $row["post_image"];
            $post_date = $row["post_date"];
            $post_tags = $row["post_tags"];
            $post_views = $row["post_views"];
            $category_title = $row["cat_title"];
            $category_id = $row["id"];
            
            echo "<tr>";
            ?>

            <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>;
            
            <?php
            echo "<td>{$post_id}</td>";
            if(!empty($post_author)){
                echo "<td>{$post_author}</td>";
            } else if(!empty($post_user)){
                echo "<td>{$post_user}</td>";
            }

            echo "<td>{$post_title}</td>";

            echo "<td>{$category_title}</td>";
            echo "<td>{$post_status}</td>";
            echo "<td><img width='100' src='../images/$post_image' alt='Post Image'></td>";
            echo "<td><a href='posts.php?reset={$post_id}'>{$post_views}</a></td>";
            echo "<td>{$post_tags}</td>";

            $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
            $send_comment_query = mysqli_query($connection, $query);
            
            $count_comments = mysqli_num_rows($send_comment_query);
            echo "<td><a href='view_post_comments.php?p_id=$post_id'>{$count_comments}</a></td>";

            echo "<td>{$post_date}</td>";
            echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>"; 
            echo "<td><a class='btn btn-info' 'href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
            ?> 
            <form method="POST">
                <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
            <?php
                echo "<td><input class='btn btn-danger' type='submit' name='delete' value='Delete'></td>";
            ?>
            </form>
        <?php  
            // echo "<td><a rel='{$post_id}' href='javascript:void(0)' class='delete-link'>Delete</a></td>";
            // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete this post?'); \" href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }
    ?>
        
    </tbody>
</table>
</form>


<?php
    if(isset($_POST["delete"])){
        $delete_post_id = $_POST["post_id"];

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

<script>
    $(document).ready(function(){
            $(".delete-link").on('click', function(){
                const id = $(this).attr("rel");
                const deleteURL = "posts.php?delete=" + id +" ";

                $(".modal-delete-link").attr("href", deleteURL);

                $("#myModal").modal('show');
            })
    })
</script>