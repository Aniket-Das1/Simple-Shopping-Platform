
    <?php include('partials-front/menu.php'); ?>


    <section class="item-search text-center">
        <div class="container">
            <?php

            
                $search = mysqli_real_escape_string($conn, $_POST['search']);

            ?>


            <h2>Items on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
   
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Items</h2>

            <?php

               
                $sql = "SELECT * FROM tbl_item WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether item available of not
                if($count>0)
                {
                    //item Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
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

                                <a href="#" class="btn btn-primary">Order Here</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Item not found.</div>";
                }

            ?>



            <div class="clearfix"></div>



        </div>

    </section>
 