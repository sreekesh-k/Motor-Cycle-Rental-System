<?php
include('db_conn.php');
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$regid = '';

if (!empty($username)) {
    // Get reg_id based on username
    $stmt = mysqli_prepare($conn, "SELECT reg_id FROM register WHERE user_name=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $regid);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt); // Close the statement after fetching results
}

$perhrcost = 0;

if (isset($_SESSION['bikeid'])) {
    $bikeid = $_SESSION['bikeid'];

    // Fetch perhour_cost based on bikeid
    $stmt2 = mysqli_prepare($conn, "SELECT perhour_cost FROM bike WHERE bike_id=? LIMIT 1");
    mysqli_stmt_bind_param($stmt2, "s", $bikeid);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_bind_result($stmt2, $perhrcost);
    mysqli_stmt_fetch($stmt2);
    mysqli_stmt_close($stmt2); // Close the statement after fetching results
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/confirm.css">
</head>

<body>

    <?php include('Header.php'); ?>

    <div class="confirm-box">
        <div class="heading">
            <h2> Do want to confirm booking ?</h2>
        </div>
        <div class="amount">
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['pickup-date']) && isset($_POST['pickup-time']) && isset($_POST['dropoff-date']) && isset($_POST['dropoff-time'])) {
                    $pdate = $_POST['pickup-date'];
                    $ptime = $_POST['pickup-time'];
                    $ddate = $_POST['dropoff-date'];
                    $dtime = $_POST['dropoff-time'];

                    function calculateHours($pdate, $ptime, $ddate, $dtime)
                    {
                        // Combine pickup and dropoff dates and times into DateTime objects
                        $pickupDatetime = new DateTime("$pdate $ptime");
                        $dropoffDatetime = new DateTime("$ddate $dtime");

                        // Calculate the difference between the two timestamps
                        $interval = $pickupDatetime->diff($dropoffDatetime);

                        // Extract the total hours from the interval object
                        $totalHours = $interval->days * 24 + $interval->h;

                        // Handle cases where minutes are greater than 30 (round up to the next hour)
                        if ($interval->i > 30) {
                            $totalHours++;
                        }
                        return $totalHours;
                    }

                    function totalamount($perhrcost, $totalHours)
                    {
                        $totalAmt = $perhrcost * $totalHours;
                        return $totalAmt;
                    }

                    // Example usage (assuming separate variables retrieved from the table)
                    $totalHours = calculateHours($pdate, $ptime, $ddate, $dtime);
                    $totalAmt = totalamount($perhrcost, $totalHours);

                    echo "<h4>Total Booking Duration: </h4>" . $totalHours . "<h4> hours </h4>";
                    echo "<h4>Total Amount: </h4>" . $totalAmt . "<h4> Rs </h4>";
                }
            }
            ?>
        </div>
        <form action="" method="post">
            <input class="btn" type="submit" name="YES" id="btn" value=YES>
            <input class="btn" type="submit" name="NO" id="btn" value="NO">
        </form>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["YES"])) {    // INSERT query using prepared statement (example)
            $pstmt = mysqli_prepare($conn, "INSERT INTO booked (reg_id, bike_id, pickup_date, pickup_time, dropoff_date, dropoff_time, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($pstmt, "ssssssd", $regid, $bikeid, $pdate, $ptime, $ddate, $dtime, $totalAmt);
            mysqli_stmt_execute($pstmt);
            header("Location: index.php");
            // Execute prepared INSERT
        }
        if (isset($_POST["NO"])) {
            unset($_SESSION["bikeid"]);
            header("Location: index.php");
        }
    }
    include('Footer.php');
    ?>

</body>

</html>