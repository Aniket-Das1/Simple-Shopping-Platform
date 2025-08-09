<?php include('partials/menu.php'); ?>

<div style="border:2px solid black;position:relative;top:20px;border-radius:80px;background-color:rgb(231, 179, 179);"class="main-content">
    <div class="wrapper">
        <h1 style="font-family: 'Tangerine', cursive;color:black;">Add Category</h1>

        <br><br>

        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

        ?>

        <br><br>

        
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td style="font-family: 'Tangerine', cursive;color:black;">Title: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;"type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;color:black;">Select Image: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;"type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;color:black;">Featured: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;"type="radio" name="featured" value="Yes"> Yes
                        <input style="border:2px solid black;border-radius:80px;"type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;color:black;">Active: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="radio" name="active" value="Yes"> Yes
                        <input style="border:2px solid black;border-radius:80px;" type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input style="background-color:rgb(244, 208, 169);font-family: 'Tangerine', cursive;color:black;border:2px solid black;border-radius:80px;" type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
        

        <?php

            //CHeck whether the Submit Button is Clicked or Not
            if(isset($_POST['submit']))
            {
               
                //1. Get the Value from CAtegory Form
                $title = $_POST['title'];

                //For Radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    
                    $featured = $_POST['featured'];
                }
                else
                {
                    //SEt the Default VAlue
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

             

                if(isset($_FILES['image']['name']))
                {
                   
                    $image_name = $_FILES['image']['name'];

                    // Upload the Image only if image is selected
                    if($image_name != "")
                    {


                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "item_Category_".rand(000, 999).'.'.$ext; 


                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path, $destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            //Redirect to Add CAtegory Page
                            header('location:'.SITEURL.'admin/add-category.php');
                            //STop the Process
                            die();
                        }

                    }
                }
                else
                {
                    //Don't Upload Image and set the image_name value as blank
                    $image_name="";
                }

                //2. Create SQL Query to Insert CAtegory into Database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                //3. Execute the Query and Save in Database
                $res = mysqli_query($conn, $sql);

                //4. Check whether the query executed or not and data added or not
                if($res==true)
                {
                    
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    //Failed to Add CAtegory
                    $_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
                    //Redirect to Manage Category Page
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }

        ?>

    </div>
</div>

