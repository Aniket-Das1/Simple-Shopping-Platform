<?php include('../config/constants.php'); ?>

<html>
    <head>
        <title>LOGIN </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body style="background-color:white;">

        <div style="background-color:rgb(244, 198, 198); border: 2px solid rgb(9, 12, 14);width: 20%;margin: 10% auto;padding: 2%;border-radius: 80px;"class="login">
            <h1 style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;"class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>

            <form action="" method="POST" class="text-center">
           <div style="font-size:20px;color:white;font-family: 'Tangerine', cursive;color:black;"> Username:</div> <br>
            <input style="border:2px solid black;border-radius:80px;" type="text" name="username" placeholder="Username"><br><br>

            <div style="font-size:20px;color:white;font-family: 'Tangerine', cursive;color:black;"> Password</div> <br>
            <input style="border:2px solid black;border-radius:80px;"type="password" name="password" placeholder="Password"><br><br>

            <input style="background-color:rgb(255, 246, 246);color:black;border:2px solid black;border-radius:50px;font-family: Tangerine;"type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            

            
        </div>

    </body>
</html>

<?php

if (isset($_POST['submit'])) {
    
    // 1. Get the Data from Login form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // No md5

    // 2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // 3. Execute the Query
    $res = mysqli_query($conn, $sql);

    // 4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
      
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;

        header('location:' . SITEURL . 'admin/');
    } else {
        
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}

?>
