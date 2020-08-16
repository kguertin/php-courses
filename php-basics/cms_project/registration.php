<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
    <?php  include "includes/navigation.php"; ?>

    <?php
        if(isset($_POST['submit'])){            
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $error = [
                'username' => '',
                'email' => '',
                'password' => ''
            ];

            if(strlen($username) < 4){
                $error['username'] = 'Username needs to be four characters or more.';
            }
            
            if(empty($username)){
                $error['username'] = 'Please enter a username.';
            }

            if(check_user($username)){
                $error['username'] = 'Username already exists.';
            }

            if(strlen($email) < 4){
                $error['email'] = 'Email needs to be four characters or more.';
            }
            
            if(empty($email)){
                $error['email'] = 'Please enter an email.';
            }

            if(check_email($email)){
                $error['email'] = "Email already assigned to an account. <a href='index.php'>Go to Login</a>";
            }

            if(empty($password)){
                $error['password'] = 'Please enter a password.';
            }

            foreach($error as $key => $value){
                if(empty($value)){
                    register_user($username, $email, $password);
                    login_user($username, $password);
                }
            }

        }
    ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>
        
<?php include "includes/footer.php"; ?>