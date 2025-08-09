
<?php include('partials/menu.php'); ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
        <!-- Main Content Section Starts -->
        <div style=" position:relative;left:440px;width:580px;position:relative; top:20px;background-color:rgb(238, 202, 202); border: 2px solid #333; border-radius: 100px; "class="main-content">
            <div class="wrapper">
                Date and Time:        

 <div style="font-family: monospace; font-size: 1.5em;">
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


  </div> 
                <br><br>
                <?php
                    if(isset($_SESSION['login']))
                    {
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br><br>

               

                <div style=" position:relative; left:50px; width:100px;border: 2px solid #333; border-radius: 80px;font-family: 'Tangerine', cursive;"class="col-4 text-center">

                    <?php
                        //Sql Query
                        $sql3 = "SELECT * FROM tbl_order";
                        //Execute Query
                        $res3 = mysqli_query($conn, $sql3);
                        //Count Rows
                        $count3 = mysqli_num_rows($res3);
                    ?>

                    <h1><?php echo $count3; ?></h1>
                    <br />
                    Total Orders
                </div>

                <div style=" position:relative; left:250px;width:100px;border: 2px solid #333; border-radius: 80px;font-family: 'Tangerine', cursive;"class="col-4 text-center">

                    <?php
                        //Creat SQL Query to Get Total Revenue Generated
                       
                        $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";

                        //Execute the Query
                        $res4 = mysqli_query($conn, $sql4);

                        //Get the VAlue
                        $row4 = mysqli_fetch_assoc($res4);

                        //GEt the Total REvenue
                        $total_revenue = $row4['Total'];

                    ?>

                    <h1>$<?php echo $total_revenue; ?></h1>
                    <br />
                    Revenue Generated
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
       
        </body>
</html>
