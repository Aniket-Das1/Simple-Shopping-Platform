<div >
<?php include('partials-front/menu.php'); ?>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping? Now Simple...</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
    background-color:white;
    background-size: cover;
    background-position: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    min-height: 100vh;
    overflow: hidden;
    font-family: Arial, sans-serif;
}


       
        .item-search {
            background-color: #333;
            padding: 20px;
            width: 100%;
            text-align: center;
        }
        .item-search input[type="search"] {
            padding: 10px 15px;
            font-size: 16px;
            border: none;
            border-radius: 25px;
            width: 300px;
            outline: none;
            transition: width 0.4s ease;
        }
        .item-search input[type="search"]:focus {
            width: 350px;
        }
        .item-search input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: #ff6b6b;
            color: white;
            border-radius: 25px;
            margin-left: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .item-search input[type="submit"]:hover {
            background-color: #ff4747;
        }

       .menu {
            background-color: #444;
            color: #fff;
            padding: 15px;

        }
        .menu a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s;
        }
        .menu a:hover {
            color: #ff6b6b;
        }

        /* 3D Slider Styling */
        .banner {
            position: relative;
            width: min(1400px, 90vw);
            height: 600px;
            perspective: 2000px;
            margin-top: 30px;
        }
        .slider {
            display: flex;
            justify-content: center;
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
            animation: rotate 20s infinite linear;
        }
        .item {
            position: absolute;
            width: 250px;
            height: 300px;
            background-color:rgb(238, 202, 202); 
            overflow: hidden;
            border:2px solid black;
            border-radius: 80px;
            transform: rotateY(calc(var(--position) * 36deg)) translateZ(600px);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: transform 0.5s;
        }
        .item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 2px solid #000;
        }
        .item h3 {
            color: #333;
            text-align: center;
            padding: 10px;
            background-color: rgba(0,0,0,0);
            width: 100%;
            font-family: 'Tangerine, cursive';
            font-size: 18px;
            font-weight: bold;
        }
        @keyframes rotate {
            from { transform: rotateY(0deg); }
            to { transform: rotateY(360deg); }
        }
        @keyframes bounce {
              0%, 100% {
           transform: translateY(0);
           }
             50% {
            transform: translateY(-20px);
               }
        }

.bouncy-text {
  display: inline-block;
  animation: bounce 1s infinite;
}
    </style>
</head>
<body>
  
<div style="position:relative;left:-520px;top:-120px;font-family: monospace; font-size: 1.5em;" > Date and Time
    <div id="date"></div>
    <div id="clock" style="font-size: 2em;"></div>
</div>

<?php
// Set timezone to Asia/Kolkata
date_default_timezone_set('Asia/Kolkata');
?>

<script>
// Initialize time and date from PHP (Asia/Kolkata)
let now = new Date("<?php echo date('Y-m-d H:i:s'); ?>");

function updateClock() {
    now.setSeconds(now.getSeconds() + 1);

    // Time formatting
    let hours = now.getHours();
    let minutes = String(now.getMinutes()).padStart(2, '0');
    let seconds = String(now.getSeconds()).padStart(2, '0');
    let ampm = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12;
    hours = hours ? hours : 12;
    hours = String(hours).padStart(2, '0');

    // Date formatting
    let day = String(now.getDate()).padStart(2, '0');
    let month = String(now.getMonth() + 1).padStart(2, '0'); // JS months are 0-based
    let year = now.getFullYear();
    let fullDate = `${day}-${month}-${year}`;

    // Display
    document.getElementById("date").innerText = fullDate;
    document.getElementById("clock").innerText = `${hours}:${minutes}:${seconds} ${ampm}`;
}

// Start ticking
updateClock();
setInterval(updateClock, 1000);
</script>


<?php
    if(isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<!-- 3D Category Slider -->
<div style="top:100px;" class="banner">
    <div  class="slider" style="--quantity: <?php echo $count; ?>;">
        <?php
            $sql = "SELECT * FROM tbl_category WHERE active='Yes'  LIMIT 10";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if($count > 0) {
                $position = 1;
                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <div  class="item" style="--position: <?php echo $position++; ?>;">
                        <a href="<?php echo SITEURL; ?>category-items.php?category_id=<?php echo $id; ?>">
                            <?php
                                if($image_name == "") {
                                    echo "<div class='error'>Image not Available</div>";
                                } else {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>">
                                    <?php
                                }
                            ?>
                            <h3 ><?php echo $title; ?></h3>
                        </a>
                    </div>
                    <?php
                }
            } else {
                echo "<div class='error'>Categories not Added.</div>";
            }
        ?>
    </div>
</div>
<section class="item-search text-center">
    <div class="container">
        <form action="<?php echo SITEURL; ?>item-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for item.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>
    </div>
</section> 

</body>
</html>
