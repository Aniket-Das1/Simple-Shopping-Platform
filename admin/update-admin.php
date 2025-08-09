<?php include('partials/menu.php'); ?>

<div  style="position:relative;top:30px;font-size:20px;font-family: 'Tangerine', cursive;border:2px solid black;border-radius:80px;background-color:rgb(231, 179, 179);"class="main-content">
    <div class="wrapper">
        <h1 style="font-family: 'Tangerine', cursive;">Update Admin</h1>

        <br><br>

        <?php 
            //1. Get the ID of Selected Admin
            $id=$_GET['id'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    // Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to Manage Admin PAge
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        
        ?>


        <form style="font-size:20px;font-family: 'Tangerine', cursive;border:2px solid black;border-radius:80px;background-color:rgb(249, 193, 193);"action="" method="POST">

            <table style="position:relative;left:20px;"class="tbl-30">
                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Full Name: </td>
                    <td>
                        <input  style="border:2px solid black;border-radius:80px;" type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Username: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input style="font-family: 'Tangerine', cursive;border:2px solid black;border-radius:80px;"type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 

    if(isset($_POST['submit']))
    {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id='$id'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

   
        if($res==true)
        {
           
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            
            $_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>


