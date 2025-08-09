<?php 

    
    if(!isset($_SESSION['user'])) //IF user session is not set
    {
       
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login </div>";
        //REdirect to Login Page
        header('location:'.SITEURL.'/User_login.php');
    }

?>
