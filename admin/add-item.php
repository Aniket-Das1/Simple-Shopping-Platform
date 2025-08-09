<?php include('partials/menu.php'); ?>

<div style="position:relative; top:20px;background-color:rgb(238, 202, 202); border: 2px solid #333; border-radius: 100px;"class="main-content">
    <div class="wrapper">
        <h1 style="font-family: 'Tangerine', cursive;color:black;">Add item</h1>

        <br><br>

        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">

                <tr>
                    <td style="font-family: 'Tangerine', cursive;color:black;">Title: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;"type="text" name="title" placeholder="Title of the Item">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;color:black;">Description: </td>
                    <td>
                        <textarea style="border:2px solid black;"name="description" cols="30" rows="5" placeholder="Description of the Item."></textarea>
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;color:black;">Price: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="number" name="price">
                    </td> 
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;color:black;">Select Image: </td>
                    <td>
                        <input style="border:2px solid black;border-radius:80px;" type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td style="font-family: 'Tangerine', cursive;color:black;">Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                //Create PHP Code to display categories from Database
                                //1. CReate SQL to get all active categories from database
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                //Executing qUery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories else we donot have categories
                                if($count>0)
                                {
                                    //WE have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];

                                        ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //WE do not have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }


                                //2. Display on Drpopdown
                            ?>

                        </select>
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
                        <input style="border:2px solid black;border-radius:80px;"type="radio" name="active" value="Yes"> Yes
                        <input style="border:2px solid black;border-radius:80px;"type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input style="border:2px solid black;border-radius:80px;"type="submit" name="submit" value="Add item" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>


        <?php

            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {


                //1. Get the DAta from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //Check whether radion button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //SEtting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //Setting Default Value
                }

                //2. Upload the Image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check Whether the Image is Selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        // Image is SElected
                        //A. REnamge the Image
                        //Get the extension of selected image (jpg, png, gif, etc.) "vijay-thapa.jpg" vijay-thapa jpg
                        $ext = end(explode('.', $image_name));

                        // Create New Name for Image
                        $image_name = "Item-Name-".rand(0000,9999).".".$ext;

                        //B. Upload the Image
                        //Get the Src Path and DEstinaton path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/item/".$image_name;


                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded of not
                        if($upload==false)
                        {
                      

                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-item.php');
                            //STop the process
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = "";
                }

                //3. Insert Into Database

                //Create a SQL Query to Save or Add
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_item SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage page
                if($res2 == true)
                {
                   
                    $_SESSION['add'] = "<div class='success'>Items Added Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-item.php');
                }
                else
                {
                    
                    $_SESSION['add'] = "<div class='error'>Failed to Add Item.</div>";
                    header('location:'.SITEURL.'admin/manage-item.php');
                }


            }

        ?>


    </div>
</div>


