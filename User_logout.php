<?php 

    include('config/constants.php');
    //1. Destory the Session
    session_destroy(); 

    //2. REdirect to Login Page
    header('location:'.SITEURL.'User_login.php');

?>