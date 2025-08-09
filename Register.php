<div style="position:relative;left:440px;width:650px;">

</div>

<div class="main-content">
    <div class="wrapper">
        <h1 style="font-size:30px;font-family: 'Tangerine', cursive;color:black;position:relative;left:180px; top:40px;">New User?Please Register..</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
            {
                echo $_SESSION['add']; //Display the SEssion Message if SEt
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form style="position:relative;left:500px; top:40px;background-color:rgb(238, 202, 202); width:520px;border: 2px solid #333; border-radius: 80px;" action="" method="POST">

            <table style="position:relative;left:80px; "class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="text" name="name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input  style="border:2px solid black;border-radius:80px;"type="submit" name="submit" value="Register" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>




<?php 
    //Process the Value from Form and Save it in Database
    define('SITEURL', 'http://localhost/shopping/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'shop');
 
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //Database Connection
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error()); //SElecting Database
    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        

        //1. Get the Data from form
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password']; 

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO users SET 
            name='$name',
            username='$username',
            password='$password'
        ";
 
        //3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the Query is Executed or not
        if($res==TRUE)
        {
            $_SESSION['add'] = "<div class='success'>Registered Successfully.</div>";
            //Redirect Page to Manage Admin
          
        }
        else
        {
           ssage
            $_SESSION['add'] = "<div class='error'>Resgistration Failed.</div>";
            //Redirect Page to Add Admin
           
        }

    }
    
?>