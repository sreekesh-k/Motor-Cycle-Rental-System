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
$url = "";
if (isset($_SESSION['bikeid'])) {
    $bikeid = $_SESSION['bikeid'];
    $stmt2 = mysqli_prepare($conn, "SELECT perhour_cost, bike_name, img_url FROM bike WHERE bike_id=? LIMIT 1");
    mysqli_stmt_bind_param($stmt2, "s", $bikeid);
    mysqli_stmt_execute($stmt2);
    mysqli_stmt_bind_result($stmt2, $perhrcost, $bike_name, $url);
    mysqli_stmt_fetch($stmt2);
    mysqli_stmt_close($stmt2);
}

?>
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
        } else {
            // Handle case where required form fields are empty
            echo "Please fill in all required fields.";
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
    <link rel="stylesheet" href="style/confirm.css">
</head>

<body>



    <div class="confirm-box">
        <h2> Confirm Your Bookings</h2>
        <div class="bookdetails">
            <div class="imagebx">
                <img src="<?php echo $url; ?>" alt="bike">
            </div>
            <div class="details">
                <?php
                echo "<h4>{$username}</h4><hr>";
                echo "<h4>{$bike_name}</h4><hr>";
                echo "<h4>Valid Till : {$_SESSION['ddate']}</h4><hr>";
                echo "<h4>Total Booking Duration: " . $totalHours . " hours </h4><hr>";
                echo "<h4>Total Amount: " . $totalAmt . " Rs </h4><hr>"; ?>
            </div>

        </div>

        <form action="" method="post">
            <input class="btn" type="submit" name="confirm" value="CONFIRM">
            <input class="btn2" type="submit" name="cancel" value="CANCEL">
        </form>

    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirm"])) {
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
        sleep(2);
        // Redirect to index.php after successful insert
        header("Location: userbooking.php");
        exit();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cancel"])) {
        unset($_SESSION["bikeid"]);
        unset($_SESSION["pdate"]);
        unset($_SESSION["ptime"]);
        unset($_SESSION["ddate"]);
        unset($_SESSION["dtime"]);
        unset($_SESSION["tamount"]);
        sleep(2);
        // Redirect to index.php
        header("Location: index.php");
        exit();
    }


    ?>

</body>

</html>