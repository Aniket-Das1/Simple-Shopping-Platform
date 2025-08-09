
    <?php include('partials-front/menu.php'); ?>

    
    <section class="item-search text-center">
        <div class="container">

            <form action="<?php echo SITEURL; ?>item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Items.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    


 
    <section style="background-color:rgb(205, 179, 152);"class="item-menu">
        <div class="container">
            <h2 class="text-center">Items</h2>

            <?php
              
                $sql = "SELECT * FROM tbl_item WHERE active='Yes'";

                $res=mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    
                    while($row=mysqli_fetch_assoc($res))
                    {
                      
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="item-menu-box">
                            <div class="item-menu-img">
                                <?php
                                 
                                    if($image_name=="")
                                    {
                                     
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {

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
                    
                    echo "<div class='error'>item not found.</div>";
                }
            ?>





         



        </div>

    </section>
  
