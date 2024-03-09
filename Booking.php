<?php
include('db_conn.php');
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$bike_id = isset($_GET['bikeid']) ? $_GET['bikeid'] : '';

if ($_SERVER["REQUEST_METHOD"] == "GET" && !empty($bike_id)) {
    // Sanitize the bike id input to prevent SQL injection
    $bike_id = mysqli_real_escape_string($conn, $bike_id);

    $sql = "SELECT * FROM bike WHERE bike_id='$bike_id'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $model = $row["model_year"];
        $cc = $row["engine_cc"];
        $bhp =  $row["bhp"];
        $img_url = $row["img_url"];
        $torque = $row["torque"];
        $transmission = $row["transmission"];
        $cost = $row["perhour_cost"];
        $bike_name = $row["bike_name"];

        $_SESSION["bikeid"] = $bike_id;
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
        <div class="bike-header">
            <?php echo "<h4>$bike_name<h4>"; ?>
        </div>

        <div class="bike-box">
            <div class="bike-image">
                <?php echo "<img src='$img_url'>"; ?>
            </div>

            <div class="bike-details">
                <ul>
                    <li>Model Year: <?php echo $model; ?></li>
                    <li>Engine CC: <?php echo $cc; ?></li>
                    <li>Power: <?php echo $bhp; ?></li>
                    <li>Torque: <?php echo $torque; ?></li>
                    <li>Transmission: <?php echo $transmission; ?></li>
                    <li>Per Hour Cost: Rs <?php echo $cost; ?></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="book-now">
        <div class="book-container">
            <form action="confirm.php" method="POST">
                <label>
                    <h2>Pickup :</h2>
                </label>
                <div class="pickup-box">
                    <input class="input" type="date" name="pickup-date" id="pickupdate" placeholder="Date" required>
                    <input class="input" type="time" name="pickup-time" id="pickuptime" placeholder="Time" required>
                </div>
                <label>
                    <h2>Dropoff :</h2>
                </label>
                <div class="dropoff-box">
                    <input class="input" type="date" name="dropoff-date" id="dropoffdate" placeholder="Date" required>
                    <input class="input" type="time" name="dropoff-time" id="dropofftime" placeholder="Time" required>
                </div>
                <input class="btn" type="submit" name="submit" id="btn" value="BOOK NOW">
            </form>
        </div>
    </div>

    <?php include('Footer.php'); ?>
</body>

</html>