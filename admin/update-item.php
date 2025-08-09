<?php include('partials/menu.php'); ?>

<?php
    //CHeck whether id is set or not
    if(isset($_GET['id']))
    {
        //Get all the details
        $id = $_GET['id'];

        //SQL Query to Get the Selected item
        $sql2 = "SELECT * FROM tbl_item WHERE id=$id";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected item
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    }
    else
    {
        //Redirect to Manage item
        header('location:'.SITEURL.'admin/manage-item.php');
    }
?>


<div style="position:relative;top:30px;font-size:20px;font-family: 'Tangerine', cursive;border:2px solid black;border-radius:80px;background-color:rgb(224, 193, 193);"  class="main-content">
    <div class="wrapper">
        <h1 style="font-family: 'Tangerine', cursive;">Update item</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">

            <tr>
                <td style="font-family: 'Tangerine', cursive;">Title: </td>
                <td>
                    <input style="border:2px solid black;border-radius:80px;"type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Tangerine', cursive;">Description: </td>
                <td>
                    <textarea style="border:2px solid black;"name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Tangerine', cursive;">Price: </td>
                <td>
                    <input style="border:2px solid black;border-radius:80px;" type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Tangerine', cursive;">Current Image: </td>
                <td>
                    <?php
                        if($current_image == "")
                        {
                            //Image not Available
                            echo "<div class='error'>Image not Available.</div>";
                        }
                        else
                        {
                            //Image Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/item/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Tangerine', cursive;">Select New Image: </td>
                <td>
                    <input style="border:2px solid black;border-radius:80px;"type="file" name="image">
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Tangerine', cursive;">Category: </td>
                <td>
                    <select style="border:2px solid black;border-radius:80px;"name="category">

                        <?php
                            //Query to Get ACtive Categories
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            //Execute the Query
                            $res = mysqli_query($conn, $sql);
                            //Count Rows
                            $count = mysqli_num_rows($res);

                           
                            if($count>0)
                            {
                                //CAtegory Available
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $category_title = $row['title'];
                                    $category_id = $row['id'];

                                   
                                    ?>
                                    <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                    <?php
                                }
                            }
                            else
                            {
                              
                                echo "<option value='0'>Category Not Available.</option>";
                            }

                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Tangerine', cursive;">Featured: </td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td style="font-family: 'Tangerine', cursive;">Active: </td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input style="border:2px solid black;border-radius:80px;font-family: 'Tangerine', cursive;" type="submit" name="submit" value="Update item" class="btn-secondary">
                </td>
            </tr>

        </table>

        </form>

        <?php

            if(isset($_POST['submit']))
            {
                
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

               
                if(isset($_FILES['image']['name']))
                {
                    //Upload BUtton Clicked
                    $image_name = $_FILES['image']['name'];

                    //CHeck whether th file is available or not
                    if($image_name!="")
                    {
                        //IMage is Available
                        //A. Uploading New Image

                        //REname the Image
                        $ext = end(explode('.', $image_name)); //Gets the extension of the image

                        $image_name = "item-Name-".rand(0000, 9999).'.'.$ext; //THis will be renamed image

                        //Get the Source Path and DEstination PAth
                        $src_path = $_FILES['image']['tmp_name']; //Source Path
                        $dest_path = "../images/item/".$image_name; //DEstination Path

                        //Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        /// CHeck whether the image is uploaded or not
                        if($upload==false)
                        {
                           
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload new Image.</div>";
                            //REdirect to Manage item
                            header('location:'.SITEURL.'admin/manage-item.php');
                            //Stop the Process
                            die();
                        }
                    
                        if($current_image!="")
                        {
                          
                            $remove_path = "../images/item/".$current_image;

                            $remove = unlink($remove_path);

                            if($remove==false)
                            {
                                
                                $_SESSION['remove-failed'] = "<div class='error'>Cannot remove current image.</div>";
                                //redirect to manage item
                                header('location:'.SITEURL.'admin/manage-item.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Default Image when Image is Not Selected
                    }
                }
                else
                {
                    $image_name = $current_image; //Default Image when Button is not Clicked
                }



                //4. Update the item in Database
                $sql3 = "UPDATE tbl_item SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not
                if($res3==true)
                {
                    //Query Exectued and item Updated
                    $_SESSION['update'] = "<div class='success'>Successfully Updated .</div>";
                    header('location:'.SITEURL.'admin/manage-item.php');
                }
                else
                {
                    $_SESSION['update'] = "<div class='error'>Cannot Update item.</div>";
                    header('location:'.SITEURL.'admin/manage-item.php');
                }


            }

        ?>

    </div>
</div>


