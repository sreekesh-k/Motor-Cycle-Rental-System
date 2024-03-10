<?php
include("db_conn.php");
session_start();
include("Header.php");
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/userbooking.css">
</head>

<body>
    <h1>Hi <?php echo $username; ?> View Your Bookings Here</h1>
    <div class="main">
        <?php
        $sql = "SELECT * FROM bike bi JOIN booked bo ON bi.bike_id = bo.bike_id JOIN register r ON bo.reg_id = r.reg_id WHERE r.reg_id={$regid} ";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='bookings'>
                        <div class='desc'><img src='{$row["img_url"]}'></div>
                        <div class='desc'><h4>{$row["bike_name"]}</h4></div>
                        <div class='desc'><h4>Drop off By: {$row["dropoff_date"]}</h4></div>
                        <div class='desc'><h4>Amount Paid Rs.{$row["price"]}</h4></div>
                    </div>";
            }
        } else {
            echo "<h2>You haven't <a href = 'index.php#fleet'>booked</a> any bikes yet</h2>";
        }
        ?>
    </div>

</body>

</html>