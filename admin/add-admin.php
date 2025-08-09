<?php include('partials/menu.php'); ?>

<div style="position:relative;top:30px;font-size:20px;font-family: 'Tangerine', cursive;border:2px solid black;border-radius:80px;background-color:rgb(231, 179, 179);"class="main-content">
    <div class="wrapper">
        <h1 style="font-family: 'Tangerine', cursive;color:black;">Add Admin</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) 
            {
                echo $_SESSION['add']; 
                unset($_SESSION['add']); 
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Full Name: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="text" name="full_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Username: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Password: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;"  type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input style="font-family: 'Tangerine', cursive;border:2px solid black;border-radius:80px;background-color:rgb(231, 179, 179);color:black;" type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


    </div>
</div>




<?php 
    

    if(isset($_POST['submit']))
    {
        
        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password']; 

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username='$username',
            password='$password'
        ";
 
        //3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql) or die(mysqli_error());

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
          
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Failed to Add Admin.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }

    }
    
?>