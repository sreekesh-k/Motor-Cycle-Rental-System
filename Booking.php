<?php
include('db_conn.php');
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = '';
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $bike_name = $_GET["bike_name"];
    $img_url = $_GET["img_url"];

    $sql = "SELECT * FROM bike WHERE bike_name='{$bike_name}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
           $model = $row["model_year"];
           $cc = $row["engine_cc"];
           $bhp =  $row["bhp"];
           $torque = $row["torque"];
           $transmission = $row["transmission"];
           $cost = $row["perhour_cost"];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/Booking.css">
</head>

<body>
    <?php include('Header.php'); ?>

    
        <div class="bike">
            <div class = "bike-header">
            <?php
            echo "<h4>$bike_name<h4>";
            ?>
            </div>
            
            <div class="bike-box">
                <div class="bike-image">
                    <?php
                    echo "<img src= '{$img_url}'>";
                    ?>
                </div>
                
                <div class="bike-details">
                    <ul>
                        <li>Model Year :  <?php echo "$model" ?></li>
                        <li>Engine cc :   <?php echo "$cc" ?></li>
                        <li>Power :   <?php echo "$bhp" ?></li>
                        <li>Torque :   <?php echo "$torque" ?></li>
                        <li>Transmission :   <?php echo "$transmission" ?></li>
                        <li>Per Hour cost :   <?php echo "Rs  $cost" ?></li>
                    </ul>
                </div>
            </div>
        </div>

    <div class = "book-now">
    <div class = "book-container"> 
    <label><h2>Pickup :</h2></label>
        <div class = "pickup-box">
            
            <div class = "input"><input type = "date" name = "pickup-date" id = "pickupdate" placeholder = "Date"></div>
            <div class = "input"><input type = "time" name = "pickup-time" id = "pickuptime" placeholder = "Time"></div>
        </div>
        <label><h2>Dropoff :</h2></label>
        <div class = "dropoff-box">
            <div class = "input"><input type = "date" name = "dropoff-date" id = "dropoffdate"  placeholder = "Date"></div>
            <div class = "input"><input type = "time" name = "dropoff-time" id = "dropofftime"  placeholder = "Time"></div>
        </div>
        <div class = "btn"><input type ="button" name = "submit" id = "btn">BOOK NOW</div>  
    </div>
    </div>
    

    <?php include('Footer.php'); ?>
</body>

</html>