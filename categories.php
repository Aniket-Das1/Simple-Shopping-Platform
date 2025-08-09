<div style="width:220px;position: relative;left:650px;">
<?php   include('partials-front/menu.php'); ?>
</div>


    <section style= "position:relative;left:250px;width:1020px; top:40px;background-color:rgb(238, 202, 202); border: 2px solid #333; border-radius: 100px;"class="categories">
        <div class="container">
            <h2 style="font-family: 'Tangerine', cursive;"class="text-center">Explore Items</h2>

            <?php

              
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //CHeck whether categories available or not
                if($count>0)
                {
                    //CAtegories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>

                        <a href="<?php echo SITEURL; ?>category-items.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name=="")
                                    {
                                        
                                        echo "<div class='error'>Image not found.</div>";
                                    }
                                    else
                                    {
                                        
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>


                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    echo "<div class='error'>Category not found.</div>";
                }

            ?>


            <div class="clearfix"></div>
        </div>
    </section>
  
  
