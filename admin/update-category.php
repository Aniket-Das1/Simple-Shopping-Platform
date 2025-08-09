<?php include('partials/menu.php'); ?>

<div style="position:relative;top:30px;font-size:20px;font-family: 'Tangerine', cursive;border:2px solid black;border-radius:80px;background-color:rgb(224, 193, 193);"  class="main-content">
    <div class="wrapper">
        <h1  style="font-family: 'Tangerine', cursive;">Update Category</h1>

        <br><br>


        <?php

            //Check whether the id is set or not
            if(isset($_GET['id']))
            {
                //Get the ID and all other details
                //echo "Getting the Data";
                $id = $_GET['id'];
                //Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the Rows to check whether the id is valid or not
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                }
                else
                {
                    //redirect to manage category with session message
                    $_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else
            {
                //redirect to Manage CAtegory
                header('location:'.SITEURL.'admin/manage-category.php');
            }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Current Image: </td>
                    <td>
                        <?php
                            if($current_image != "")
                            {
                                
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            else
                            {
                                
                                echo "<div class='error'>Image Not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;">New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Featured: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;"  <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                        <input style="border:2px solid black;border-radius:80px;" <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;">Active: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;"  <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes

                        <input style="border:2px solid black;border-radius:80px;"  <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input style="border:2px solid black;border-radius:80px;"  type="hidden" name="id" value="<?php echo $id; ?>">
                        <input style="border:2px solid black;border-radius:80px;"  type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

            if(isset($_POST['submit']))
            {
                
                $id = $_POST['id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

               
                if(isset($_FILES['image']['name']))
                {
                    
                    $image_name = $_FILES['image']['name'];

                    //Check whether the image is available or not
                    if($image_name != "")
                    {
                        
                        $ext = end(explode('.', $image_name));

                        //Rename the Image
                        $image_name = "item_Category_".rand(000, 999).'.'.$ext; 


                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                       
                        $upload = move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            //SEt message
                            $_SESSION['upload'] = "<div class='error'>Couldn't Upload Image. </div>";
                            //Redirect to Add CAtegory Page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //STop the Process
                            die();
                        }

                        
                        if($current_image!="")
                        {
                            $remove_path = "../images/category/".$current_image;

                            $remove = unlink($remove_path);

                            //CHeck whether the image is removed or not
                          
                            if($remove==false)
                            {
                               
                                $_SESSION['failed-remove'] = "<div class='error'>Couldn't remove  Image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();//Stop the Process
                            }
                        }


                    }
                    else
                    {
                        $image_name = $current_image;
                    }
                }
                else
                {
                    $image_name = $current_image;
                }

                //3. Update the Database
                $sql2 = "UPDATE tbl_category SET
                    title = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                
                if($res2==true)
                {
                    $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else
                {
                    
                    $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }

        ?>

    </div>
</div>


