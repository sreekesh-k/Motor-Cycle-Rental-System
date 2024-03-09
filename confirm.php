<?php
include('db_conn.php');
session_start();

$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
$regid = '';

if (!empty($username)) {
    $stmt = mysqli_prepare($conn, "SELECT reg_id FROM register WHERE user_name=?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $regid);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}

$perhrcost = 0;

if (isset($_SESSION['bikeid'])) {
    $bikeid = $_SESSION['bikeid'];

    $stmt2 = mysqli_prepare($conn, "SELECT perhour_cost FROM bike WHERE bike_id=? LIMIT 1");
    mysqli_stmt_bind_param($stmt2, "s", $bikeid);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_bind_result($stmt2, $perhrcost);
    mysqli_stmt_fetch($stmt2);
    mysqli_stmt_close($stmt2);
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
            <h2> Do you want to confirm the booking?</h2>
        </div>
        <div class="amount">
            <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (isset($_POST['pickup-date'], $_POST['pickup-time'], $_POST['dropoff-date'], $_POST['dropoff-time'])) {
                    $pdate = $_POST['pickup-date'];
                    $ptime = $_POST['pickup-time'];
                    $ddate = $_POST['dropoff-date'];
                    $dtime = $_POST['dropoff-time'];
                    $_SESSION['pdate'] = $pdate;
                    $_SESSION['ptime'] = $ptime;
                    $_SESSION['ddate'] = $ddate;
                    $_SESSION['dtime'] = $dtime;
                    // Validate form data
                    if (!empty($pdate) && !empty($ptime) && !empty($ddate) && !empty($dtime)) {
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
                        $_SESSION["tamount"] = $totalAmt;
                        echo "<h4>Total Booking Duration: </h4>" . $totalHours . "<h4> hours </h4>";
                        echo "<h4>Total Amount: </h4>" . $totalAmt . "<h4> Rs </h4>";
                    } else {
                        // Handle case where required form fields are empty
                        echo "Please fill in all required fields.";
                    }
                }
            }
            ?>
            <form action="" method="post">
                <input class="btn" type="submit" name="confirm" value="YES">
                <input class="btn" type="submit" name="cancel" value="NO">
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm"])) { {
            // Validate form data (optional, if already validated above)
            $pdate = $_SESSION['pdate'];
            $ptime = $_SESSION['ptime'];
            $ddate = $_SESSION['ddate'];
            $dtime = $_SESSION['dtime'];
            $totalAmt = $_SESSION['tamount'];
            // INSERT query using prepared statement
            $pstmt = mysqli_prepare($conn, "INSERT INTO booked (reg_id, bike_id, pickup_date, pickup_time, dropoff_date, dropoff_time, price) VALUES (?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($pstmt, "ssssssd", $regid, $bikeid, $pdate, $ptime, $ddate, $dtime, $totalAmt);
            mysqli_stmt_execute($pstmt);
            mysqli_stmt_close($pstmt);
            unset($_SESSION["bikeid"]);
            unset($_SESSION["pdate"]);
            unset($_SESSION["ptime"]);
            unset($_SESSION["ddate"]);
            unset($_SESSION["dtime"]);
            unset($_SESSION["tamount"]);
            // Redirect to index.php after successful insert
            header("Location: index.php");
            exit();
        }
        if ($_SERVER["REQUEST_METHOD" == "POST"] && isset($_POST["cancel"])) {
            unset($_SESSION["bikeid"]);
            // Redirect to index.php
            header("Location: index.php");
            exit();
        }
    }

    include('Footer.php');
    ?>

</body>

</html>