<?php

    include('config/constants.php');
    include('loginconfirm.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="css/style.css">
</head>

<body >

    <section class=>
        <div >

            <div style="position:relative; top:20px;background-color:rgb(238, 202, 202); border: 2px solid #333; border-radius: 100px;" class="menu text-center">
                <ul>
                    <li>
                        <a style="font-size:20px;font-family: 'Tangerine', cursive;color:black;"href="<?php echo SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a style="font-size:20px;color:black;font-family: 'Tangerine', cursive;"href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    
                  
                </ul>
            </div>
            <div><a style=" position:relative;top:-10px;left:800px;font-family: 'Tangerine', cursive;  color: red; text-decoration: none;font-size: 18px;" href="User_logout.php">Logout</a></div>
           
        </div>
    </section>
 
