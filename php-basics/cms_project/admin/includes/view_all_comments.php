<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * FROM comments";
        $select_comments = mysqli_query($connection, $query);
        
        while($row = mysqli_fetch_assoc($select_comments)){
            $comment_id = $row["comment_id"];
            $comment_post_id = $row["comment_post_id"]; 
            $comment_author = $row["comment_author"];
            $comment_content = $row["comment_content"]; 
            $comment_email = $row["comment_email"];
            $comment_status = $row["comment_status"];
            $comment_date = $row["comment_date"];
            
            echo "<tr>";
            echo "<td>{$comment_id}</td>";
            echo "<td>{$comment_author}</td>";
            echo "<td>{$comment_content}</td>";
            echo "<td>{$comment_email}</td>";
            echo "<td>{$comment_status}</td>";
            
            // Get category title matching category id 
            // $query = "SELECT * FROM categories WHERE id = $post_category_id";
            // $select_category_id = mysqli_query($connection, $query);
            
            // $category_result = mysqli_fetch_assoc($select_category_id);
            // $cat_title = $category_result["cat_title"];
            
            echo "<td>Some title</td>";
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='posts.php?source=edit_post&pid={$post_id}'>Approve</a></td>";      
            echo "<td><a href='posts.php?delete={$post_id}'>Unapprove</a></td>";    
            echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
            
            echo "</tr>";
        }


    ?>
        
    </tbody>
</table>


<?php
    if(isset($_GET["delete"])){
        $delete_post_id = $_GET["delete"];

        $query = "DELETE FROM posts where post_id = {$delete_post_id} ";
        $delete_query = mysqli_query($connection, $query);

        confirm_query($delete_query);

        header("Location: posts.php");
    }
?>