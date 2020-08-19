<?php include "./admin/functions.php"; ?>
<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
            <?php
                if(isset($_GET["p_id"])){
                    $current_post_id = $_GET["p_id"];
                    $post_author = $_GET["author"];
                }
            ?>
            
            <h1 class="page-header">All posts by <?php echo $post_author; ?></a></h1>

            <?php
            $query = "SELECT * FROM posts WHERE post_user = '{$post_author}'";
                $select_all_posts = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_all_posts)){
                    $post_title = $row["post_title"];
                    $post_author = $row["post_user"];
                    $post_date = $row["post_date"];
                    $post_image = $row["post_image"];
                    $post_content = $row["post_content"];
                    $post_id = $row['post_id']

            ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $post_id ?>"><?php echo $post_title; ?></a>
                </h2>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id ?>">
                    <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

            <?php } ?>

        
            <hr>

                

            </div>

        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php include "includes/footer.php"; ?>