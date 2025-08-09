
<?php include('config/constants.php'); ?>
<html>
    <head>
        <title>Login </title>
        <link rel="stylesheet" href="css/admin.css">
    </head>
    <style>
@keyframes bounce {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-15px);
  }
}

.bounce-word span {
  display: inline-block;
  animation: bounce 1s infinite;
}

/* Delays for at least 10 letters */
.bounce-word span:nth-child(1)  { animation-delay: 0s; }
.bounce-word span:nth-child(2)  { animation-delay: 0.1s; }
.bounce-word span:nth-child(3)  { animation-delay: 0.2s; }
.bounce-word span:nth-child(4)  { animation-delay: 0.3s; }
.bounce-word span:nth-child(5)  { animation-delay: 0.4s; }
.bounce-word span:nth-child(6)  { animation-delay: 0.5s; }
.bounce-word span:nth-child(7)  { animation-delay: 0.6s; }
.bounce-word span:nth-child(8)  { animation-delay: 0.7s; }
.bounce-word span:nth-child(9)  { animation-delay: 0.8s; }
.bounce-word span:nth-child(10) { animation-delay: 0.9s; }
/* Add more if needed */
</style>
    <body style="background-color:white;">
   <a style=" font-family: 'Tangerine', cursive;  color: red; text-decoration: none;font-size: 18px;" href="Register.php">New User?Register here..</a>
   <div></div><a style=" font-family: 'Tangerine', cursive;  color: red; text-decoration: none;font-size: 18px;" href="admin\login.php">Admin page</a>
        <div style="background-color:rgb(244, 198, 198); border: 2px solid rgb(9, 12, 14);
    width: 30%;
    margin: 10% auto;
    padding: 2%;
    border-radius: 80px;"class="login">
            <h1 style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;"class="bounce-word">
  <span style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;">U</span>
  <span style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;">S</span>
  <span style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;">E</span>
  <span style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;">R</span>
  <span>__</span>
  <span style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;">L</span>
  <span style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;">O</span>
  <span style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;">G</span>
  <span style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;">I</span>
  <span style="font-size:40px;color:white;font-family: 'Tangerine', cursive;color:black;">N</span></h1>
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

            <!-- Login Form Starts HEre -->
            <form action="" method="POST" class="text-center">
           <div style="font-size:20px;font-family: 'Tangerine', cursive;color:black;"> Username:</div> <br>
            <input style="border:2px solid black;border-radius:80px;" type="text" name="username" placeholder="Username"><br><br>

            <div style="font-size:20px;font-family: 'Tangerine', cursive;color:black;"> Password</div> <br>
            <input style="border:2px solid black;border-radius:80px;"type="password" name="password" placeholder="Password"><br><br>

            <input style="background-color:rgb(255, 246, 246);color:black;border:2px solid black;border-radius:50px;font-family: Tangerine;"type="submit" name="submit" value="Login" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Ends HEre -->

            
        </div>

    </body>
</html>

<?php

// Check whether the Submit Button is Clicked or Not
if (isset($_POST['submit'])) {
    
    // 1. Get the Data from Login form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']); // No md5

    // 2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";

    // 3. Execute the Query
    $res = mysqli_query($conn, $sql);

    // 4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // User Available and Login Success
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username;

        // Redirect to Dashboard
        header('location:' . SITEURL . 'index.php');
    } else {
       
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('location:' . SITEURL . 'User_login.php'); 
    }
}

?>
