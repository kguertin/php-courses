<?php include "includes/header.php"; ?>
<?php 
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_profile = mysqli_query($connection, $query);

    $user_data = mysqli_fetch_array($select_user_profile);

    $user_id = $user_data["user_id"];
    $username = $user_data["username"]; 
    $user_password = $user_data["user_password"];
    $user_first_name = $user_data["user_first_name"]; 
    $user_last_name = $user_data["user_last_name"];
    $user_email = $user_data["user_email"];
    $user_image = $user_data["user_image"];
    $user_role = $user_data["user_role"];
    } 
?>

<?php 
    if(isset($_POST["update_user"])) {
        $user_first_name = $_POST["user_first_name"];
        $user_last_name = $_POST["user_last_name"];
        $user_role = $_POST["user_role"];
        $user_email = $_POST["user_email"];
        $username = $_POST["username"];
        $user_password = $_POST["user_password"];


        $query = "UPDATE users SET ";
        $query .= "user_first_name = '{$user_first_name}', ";
        $query .= "user_last_name = '{$user_last_name}', ";
        $query .= "user_role= '{$user_role}', "; 
        $query .= "username = '{$username}', ";
        $query .= "user_email = '{$user_email}', ";
        $query .= "user_password = '{$user_password}' ";
        $query .= "WHERE username = '{$username}' ";

        $update_user = mysqli_query($connection, $query);
        
        confirm_query($update_user);
        header("Location: users.php");
    
    }
?>

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
        <input type="submit" class="btn btn-primary" name="update_user" value="Update Profile">
    </div>
</form>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include "includes/footer.php"; ?>