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
            
            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
            $select_post_comments = mysqli_query($connection, $query);

            $post_result = mysqli_fetch_assoc($select_post_comments);
            $post_id = $post_result["post_id"];
            $post_title  = $post_result['post_title'];

            echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
            echo "<td>{$comment_date}</td>";
            echo "<td><a href='comments.php?approve={$comment_id}'>Approve</a></td>";      
            echo "<td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>";    
            echo "<td><a href='comments.php?delete={$comment_id}'>Delete</a></td>";
            
            echo "</tr>";
        }


    ?>
        
    </tbody>
</table>


<?php

    if(isset($_GET["unapprove"])){
        $unapprove_comment_id = $_GET["unapprove"];

        $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = '$unapprove_comment_id' ";
        $unapprove_comment_query = mysqli_query($connection, $query);

        confirm_query($unapprove_comment_query);

        header("Location: comments.php");
    }

    if(isset($_GET["approve"])){
        $approve_comment_id = $_GET["approve"];

        $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '$approve_comment_id' ";
        $approve_comment_query = mysqli_query($connection, $query);

        confirm_query($approve_comment_query);

        header("Location: comments.php");
    }

    if(isset($_GET["delete"])){
        $delete_comment_id = $_GET["delete"];

        $query = "DELETE FROM comments where comment_id = {$delete_comment_id} ";
        $delete_query = mysqli_query($connection, $query);

        confirm_query($delete_query);

        header("Location: comments.php");
    }
?>