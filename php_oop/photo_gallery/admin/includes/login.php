<?php require_once('init.php'); ?>
<?php

if($session->is_signed_in()){
    redirect('../index.php');
}

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //CHeck db for user
    
    if($user_found){
        $session->log_in($user_found);
        redirect('../index.php');
    } else {
        $error_message = "Your password or username is incorrect";
    }
} else {
    $username = "";
    $password = "";
}