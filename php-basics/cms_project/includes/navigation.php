<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/php-courses/php-basics/cms_project/">CMS Front</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php
                    $query = "SELECT * FROM categories";
                    $select_all_catagories = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_all_catagories)){
                        $cat_title = $row["cat_title"];
                        $cat_id = $row['id'];

                        $category_class = '';
                        $registration_class = '';

                        $page_name = basename($_SERVER['PHP_SELF']);
                        $registration = 'registration.php';

                        if(isset($_GET['category']) && $_GET['category'] == $cat_id) {
                            $category_class = 'active';
                        } else if($page_name == $registration) {
                            $registration_class = 'active';
                        }
                        
                        echo "<li class='$category_class'><a href='/php-courses/php-basics/cms_project/category/{$cat_id}'>{$cat_title}</a></li>";
                    }
                ?>
                <?php if(is_logged_in()): ?>
                    <li><a href="/php-courses/php-basics/cms_project/admin">Admin</a></li>
                    <li><a href="/php-courses/php-basics/cms_project/includes/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="/php-courses/php-basics/cms_project/login.php">Login</a></li>
                    <li class='<?php echo $registration_class; ?>'><a href="/php-courses/php-basics/cms_project/registration">Registration</a></li>
                <?php endif; ?>
                    <li><a href="/php-courses/php-basics/cms_project/contact">Contact</a></li>
                <?php 
                    if(isset($_SESSION['user_role'])){
                        if(isset($_GET['p_id'])){
                            $post_id = $_GET['p_id'];
                            echo "<li><a href='/php-courses/php-basics/cms_project/admin/posts.php?source=edit_post&p_id={$post_id}'>Edit Post</a></li>";
                        }
                    }
                ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>