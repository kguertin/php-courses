<?php include "includes/header.php"; ?>
<?php if(isset($_SESSION['username'])){

} ?>

    <div id="wrapper">

      <?php include "includes/navigation.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small>Author</small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
<form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_first_name">First Name</label>
        <input type="text" class="form-control" value="<?php echo $user_first_name ?>" name="user_first_name" id="user_first_name">
    </div>

    <div class="form-group">
        <label for="user_last_name">Last Name</label>
        <input type="text" class="form-control" value="<?php echo $user_last_name ?>" name="user_last_name" id="user_last_name">
    </div>

    <div class="form-group">
        <select name="user_role" id="">
        <option value="<?php echo $user_role ?>"><?php echo $user_role ?></option>
        <?php
            if($user_role == 'admin'){
                echo "<option value='subscriber'>subscriber</option>";

            } else {
                echo "<option value='admin'>admin</option>";
            }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" value="<?php echo $username ?>" class="form-control" name="username" id="username">
    </div>

    <div class="form-group">
        <label for="user_email">email</label>
        <input type="email" class="form-control" value="<?php echo $user_email ?>" name="user_email" id="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" value="<?php echo $user_password ?>" name="user_password" id="user_password">
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>
</form>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/footer.php"; ?>