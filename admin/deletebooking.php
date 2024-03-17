<?php

include('../db_conn.php');

$bid = $_GET['bikeid'];
$rid = $_GET['regid'];
$query = "DELETE FROM `booked` WHERE `bike_id` = '$bid' AND reg_id='$rid'";

$run = mysqli_query($conn, $query);

if ($run == true) {
?>

    <script type="text/javascript">
        alert("Booking Deleted Successfully!");
        window.open('bookingdetail.php', '_self');
    </script>

<?php
}

?>