<?php

    include('../config/constants.php');
    include('login-check.php');

?>


<html>
    <head>
   

        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div  style="background-color:rgb(244, 198, 198); border: 2px solid black; border-radius: 80px; padding: 10px; white-space: nowrap;width:450px"class="menu text-center">
            <br><br><div style="position:relative;top:5px;"class="wrapper">
                <ul>
                    <li><a style="font-size:20px;color:white;font-family: 'Tangerine', cursive;"href="index.php">Home</a></li>
                    <li><a style="font-size:20px;font-family: 'Tangerine', cursive;"href="manage-admin.php">Admin</a></li>
                    <li><a style="font-size:20px;color:white;font-family: 'Tangerine', cursive;"href="manage-category.php">Category</a></li>
                    <li><a style="font-size:20px;font-family: 'Tangerine', cursive;"href="manage-item.php">Item</a></li>
                    <li><a style="font-size:20px;color:white;font-family: 'Tangerine', cursive;"href="manage-order.php">Order</a></li>
                   
                </ul>
            </div>
            <div style="position:relative;left:1250px;background-color: transparent; border: 1px solid black; border-radius: 10px; padding: 10px; white-space: nowrap;width:150px"><a style=" font-family: 'Tangerine', cursive;  color: red; text-decoration: none;font-size: 18px;" href="logout.php">Logout</a></div>
        </div>
        
