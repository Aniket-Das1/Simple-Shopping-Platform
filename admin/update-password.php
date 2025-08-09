<?php include('partials/menu.php'); ?>

<div style="position:relative;top:30px;font-size:20px;font-family: 'Tangerine', cursive;border:2px solid black;border-radius:80px;background-color:rgb(224, 193, 193);" class="main-content">
    <div class="wrapper">
        <h1 style="font-family: 'Tangerine', cursive;">Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Current Password: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;">New Password:</td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;"  type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Confirm Password: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input  type="hidden" name="id" value="<?php echo $id; ?>">
                        <input style="border:2px solid black;border-radius:80px;" type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php 

            //CHeck whether the Submit Button is Clicked on Not
            if(isset($_POST['submit']))
            {
                //echo "CLicked";

                //1. Get the DAta from Form
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);


                //2. Check whether the user with current ID and Current Password Exists or Not
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //CHeck whether data is available or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                       
                        if($new_password==$confirm_password)
                        {
                            //Update the Password
                            $sql2 = "UPDATE tbl_admin SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";

                            //Execute the Query
                            $res2 = mysqli_query($conn, $sql2);

                            //CHeck whether the query exeuted or not
                            if($res2==true)
                            {
                               
                                $_SESSION['change-pwd'] = "<div class='success'>Password Changed. </div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                
                                $_SESSION['change-pwd'] = "<div class='error'>Cannot Change Password. </div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else
                        {
                            //REdirect to Manage Admin Page with Error Message
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password did not Match. </div>";
                            //Redirect the User
                            header('location:'.SITEURL.'admin/manage-admin.php');

                        }
                    }
                    else
                    {
                        
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                        //Redirect the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

            }

?>


