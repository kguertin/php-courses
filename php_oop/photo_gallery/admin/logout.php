<?php require_once('./includes/header.php'); ?>
<?php
   $session->logout();
   redirect('login.php'); 
?>
<?php require_once('includes/footer.php'); ?>