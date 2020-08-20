<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<?php  include "includes/header.php"; ?>
<?php include "includes/navigation.php"; ?>

<?php
    
    // Load Composer's autoloader
    require 'vendor/autoload.php';



    if(!isset($_GET['forgot'])){
        redirect('index');
    }

    if(check_method('POST')){
        if($_POST['email']){
            $email = $_POST['email'];
            $length = 50;
            $token = bin2hex(openssl_random_pseudo_bytes($length));

            if(check_email($email)){

                if($stmt = mysqli_prepare($connection, "UPDATE users SET token='{$token}' WHERE user_email = ?")){
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);

                    // Configure PHP Mailer

                    $mail = new PHPMailer();
                    
                    //Server settings             
                    $mail->isSMTP();                                           
                    $mail->Host       = Config::SMTP_HOST ;         
                    $mail->Username   = Config::SMTP_USER;                     
                    $mail->Password   = Config::SMTP_PASS;                             
                    $mail->Port       = Config::SMTP_PORT;                         
                    $mail->SMTPAuth   = true;                                  
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->isHTML(true);  
                    $mail->CharSet = 'UTF-8';

                    $mail->setFrom('kevin.m.guertin@gmail.com', 'Kevin');
                    $mail->addAddress($email);
                    $mail->Subject = "This is a test email.";
                    $mail->Body = "<p>Click to reset Password
                        <a href='http://localhost/php-courses/php-basics/cms_project/reset.php?email=" . $email . "&token=" . $token . "'>Click Here</a>
                        </p>";


                    if($mail->send()){
                        $email_sent = true;
                    } 

                } else {
                    echo mysql_error($connection);
                }

            }
        }
    }
?>


<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                            <?php if(!isset($email_sent)): ?>
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->
                            <?php else: ?>
                                <h2>Please check your email.</h2>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

