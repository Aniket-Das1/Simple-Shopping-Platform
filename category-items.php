
    <?php include('partials-front/menu.php'); ?>

    <?php
        //CHeck whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            // Get the CAtegory Title Based on Category ID
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Get the value from Database
            $row = mysqli_fetch_assoc($res);
            //Get the TItle
            $category_title = $row['title'];
        }
        else
        {
            
            header('location:'.SITEURL);
        }
    ?>


  
    <section class="item-search text-center">
        <div class="container">

            <h2>Items available under <?php echo $category_title; ?></h2>

        </div>
    </section>
  
    <section style="position:relative; top:20px;background-color:rgb(238, 202, 202); border: 2px solid #333; border-radius: 100px;"class="item-menu">
        <div class="container">
            <h2 class="text-center">Items</h2>

            <?php

                //Create SQL Query to Get items based on Selected CAtegory
                $sql2 = "SELECT * FROM tbl_item WHERE category_id=$category_id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the Rows
                $count2 = mysqli_num_rows($res2);

                //CHeck whether item is available or not
                if($count2>0)
                {
                    //item is Available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>

                        <div class="item-menu-box">
                            <div class="item-menu-img">
                                <?php
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>

                            </div>

                            <div class="item-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="item-price">$<?php echo $price; ?></p>
                                <p class="item-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?item_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
            
                    echo "<div class='error'>item not Available.</div>";
                }

            ?>



            <div class="clearfix"></div>



        </div>

    </section>
   
 
