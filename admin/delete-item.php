<?php
    
    include('../config/constants.php');



    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or 'AND'
    {
      

        //1.  Get ID and Image NAme
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];


        if($image_name != "")
        {
            $path = "../images/item/".$image_name;

         
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                //REdirect to Manage
                header('location:'.SITEURL.'admin/manage-item.php');
                //Stop the Process of Deleting
                die();
            }

        }

        //3. Delete  from Database
        $sql = "DELETE FROM tbl_item WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

     
        if($res==true)
        {
            // Deleted
            $_SESSION['delete'] = "<div class='success'>Item Deleted Successfully.</div>";\
            header('location:'.SITEURL.'admin/manage-item.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete item.</div>";\
            header('location:'.SITEURL.'admin/manage-item.php');
        }



    }
    else
    {
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-item.php');
    }

?>
