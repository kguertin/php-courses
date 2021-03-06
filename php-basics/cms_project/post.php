<?php include "./admin/functions.php"; ?>
<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<?php
    if(isset($_POST['liked'])){
        $liked_post = $_POST['post_id'];
        $user_id = $_POST['user_id'];

        $find_post = "SELECT * FROM posts where post_id = {$liked_post}";
        $post_result = mysqli_query($connection, $find_post);
        $post = mysqli_fetch_array($post_result);
        $likes = $post['post_likes'];

        mysqli_query($connection, "UPDATE posts SET post_likes = $likes + 1 WHERE post_id = $liked_post ");

        mysqli_query($connection, "INSERT INTO likes(user_id, post_id) VALUES ($user_id, $liked_post)");
        exit();
    }

    if(isset($_POST['unliked'])){
        $unliked_post = $_POST['post_id'];
        $user_id = $_POST['user_id'];

        $find_post = "SELECT * FROM posts where post_id = {$unliked_post}";
        $post_result = mysqli_query($connection, $find_post);
        $post = mysqli_fetch_array($post_result);
        $likes = $post['post_likes'];

        mysqli_query($connection, "UPDATE posts SET post_likes = $likes - 1 WHERE post_id = $unliked_post ");

        mysqli_query($connection, "DELETE FROM likes WHERE post_id = $unliked_post AND user_id = $user_id ");
        exit();
    }

?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php
                if(isset($_GET["p_id"])){
                    $post_id = $_GET["p_id"];

                    $view_query = "UPDATE posts SET post_views = post_views + 1 WHERE post_id = $post_id ";
                    $send_query = mysqli_query($connection, $view_query);
                    
                    if(!$send_query){
                        die("Query Failed." . mysqli_error($connection));
                    }

                    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                        $query = "SELECT * FROM posts WHERE post_id = {$post_id}";
                    } else {
                    $query = "SELECT * FROM posts WHERE post_id = {$post_id} AND post_status = 'published' ";
                    }
                
                        $select_all_posts = mysqli_query($connection, $query);

                        if(mysqli_num_rows($select_all_posts) < 1){
                            echo "<h1 class='text-center'>No Post Found</h1>";
                        } else {

                        $post_data = mysqli_fetch_assoc($select_all_posts);
                        $post_title = $post_data["post_title"];
                        $post_author = $post_data["post_user"];
                        $post_date = $post_data["post_date"];
                        $post_image = $post_data["post_image"];
                        $post_content = $post_data["post_content"];

                            ?>

                        <h1 class="page-header">
                        Posts
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $post_title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="/php-courses/php-basics/cms_project/author_posts.php?author=<?php  echo $post_author; ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                        <hr>
                        <img class="img-responsive" src="/php-courses/php-basics/cms_project/images/<?php echo placeholder_image($post_image); ?>" alt="">
                        <hr>
                        <p><?php echo $post_content; ?></p>

                        <hr>
                        <?php if(is_logged_in()): ?>
                        <div class="row">
                            <p class="pull-right"><a class="<?php echo check_user_liked($post_id) ? 'unlike' : 'like';  ?>" href=""><span class="glyphicon glyphicon-thumbs-up"></span> <?php echo check_user_liked($post_id) ? ' Unlike' : ' Like';  ?></a></p>
                        </div>
                        <?php endif; ?>
                        <div class="row">
                            <p class="pull-right">Likes: <?php get_post_likes($post_id) ?></p>
                        </div>

                        <div class="clearfix"></div>

            <?php
                if(isset($_POST["create_comment"])){
                    $submit_post_id = $_GET["p_id"];
                    $comment_author = $_POST["comment_author"];
                    $comment_email = $_POST["comment_email"];
                    $comment_content = $_POST["comment_content"];
                    
                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)) {
                        
                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";
                        $query .= "VALUES ($submit_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now()) ";

                        $submit_comment_result = mysqli_query($connection, $query);
                        confirm_query($submit_comment_result);
                            
                    } else {
                        echo "<script>alert('Fields cannot be empty!')</script>";
                    }
                }
            ?>

            <!-- Comment Form -->
            <div class="well">
                <h4>Leave a Comment:</h4>
                <form action="" method="POST" role="form">
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" id="author" class="form-control" name="comment_author">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="comment_email">
                    </div>
                    <div class="form-group">
                        <label for="comment">Your Comment</label>
                        <textarea class="form-control" id="body" name="comment_content" rows="3"></textarea>
                    </div>
                    <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                </form>
            </div>

            <hr>

                <!-- Posted Comments -->
                <?php
                    $query = "SELECT * from comments WHERE comment_post_id = $post_id ";
                    $query .= "AND comment_status = 'approved'";
                    $query .= "ORDER BY comment_id DESC";
                    $select_comments_query = mysqli_query($connection, $query);

                    confirm_query($select_comments_query);

                    while($row = mysqli_fetch_assoc($select_comments_query)){
                        $comment_date = $row["comment_date"];
                        $comment_content = $row["comment_content"];
                        $comment_author = $row["comment_author"];

                        ?>

                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment_author; ?>
                                <small><?php echo $comment_date; ?></small>
                            </h4>
                            <?php echo $comment_content; ?>
                        </div>
                    </div>


                    <?php } } } else {
                        header("Location: index.php");
                    } ?>

            </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php"; ?>

<script>
    $(document).ready(function(){

        const post_id = <?php echo $post_id ?>;
        const user_id = <?php echo get_user_id(); ?>;

        $('.like').click(function(){
            $.ajax({
                url: "/php-courses/php-basics/cms_project/post.php?p_id=<?php echo $post_id; ?>",
                type: "POST",
                data: {
                    liked: 1,
                    post_id: post_id,
                    user_id: user_id,
                }
            })
        })


        $('.unlike').click(function(){
            $.ajax({
                url: "/php-courses/php-basics/cms_project/post.php?p_id=<?php echo $post_id; ?>",
                type: "POST",
                data: {
                    unliked: 1,
                    post_id: post_id,
                    user_id: user_id,
                }
            })
        })
    })
</script>