<?php include "includes/header.php"; ?>

    <div id="wrapper">

      <?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Post Comments

                        </h1>
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
                                $query = "SELECT * FROM comments WHERE comment_post_id =" .  mysqli_real_escape_string($connection, $_GET['p_id']);
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
                                    
                                    $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                    $select_post_comments = mysqli_query($connection, $query);

                                    $post_result = mysqli_fetch_assoc($select_post_comments);
                                    $post_id = $post_result["post_id"];
                                    $post_title  = $post_result['post_title'];

                                    echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
                                    echo "<td>{$comment_date}</td>";
                                    echo "<td><a href='view_post_comments.php?approve={$comment_id}&p_id=" . $_GET['p_id'] ."'>Approve</a></td>";      
                                    echo "<td><a href='view_post_comments.php?unapprove={$comment_id}&p_id=" . $_GET['p_id'] ."'>Unapprove</a></td>";    
                                    echo "<td><a href='view_post_comments.php?delete={$comment_id}&p_id=" . $_GET['p_id'] ."'>Delete</a></td>";
                                    
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

                                header("Location: view_post_comments.php?p_id=" . $_GET['p_id']);
                            }

                            if(isset($_GET["approve"])){
                                $approve_comment_id = $_GET["approve"];

                                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = '$approve_comment_id' ";
                                $approve_comment_query = mysqli_query($connection, $query);

                                confirm_query($approve_comment_query);

                                header("Location: view_post_comments.php?p_id=" . $_GET['p_id']);
                            }

                            if(isset($_GET["delete"])){
                                $delete_comment_id = $_GET["delete"];

                                $query = "DELETE FROM comments where comment_id = {$delete_comment_id} ";
                                $delete_query = mysqli_query($connection, $query);

                                confirm_query($delete_query);

                                header("Location: view_post_comments.php?p_id=" . $_GET['p_id']);
                            }
                        ?>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/footer.php"; ?>