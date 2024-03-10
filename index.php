<?php include('db_conn.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motorcycle Rental Management System</title>
    <link rel="stylesheet" href="style/Homepage.css"> <!-- Link to your CSS file -->
</head>

<?php include('Header.php'); ?>

<section class="hero">
    <h1>Welcome to MotorBeam Motorcycle Rental</h1>
    <p>Explore our wide range of motorcycles for rent.</p>
    <a href="#fleet" class="btn">Book Now</a>
</section>

<div class=about-us>
    <div class=about-header>
        <h4>WELCOME TO MOTORBEAM</h4>
    </div>
    <div class=about-content>" MotorBeam is a high-end luxury motorcycle rental company based in Kochi, Kerala.<br> Our mission is to provide an unparalleled experience to motorcycle enthusiasts who seek the thrill of riding <br>premium motorcycles without the hassle of ownership. We offer a wide range of top-of-the-line motorcycles, meticulously maintained and serviced to ensure a smooth and safe ride. "</div>
</div>

<div class="locations">
    <h5>OUR LOCATIONS</h5>
    <div class="location">
        <div class="loc">
            <div class="loc-heading">
                <h2>Kalamassery</h2>
            </div>
            <div class="loc-add">40/2265, St Benedicts road,PKA Nagar, Kalamassery, kochi, Kerala 6832033, India <br>Contact : +91 9898982336 </div>
        </div>
        <div class="loc">
            <div class="loc-heading">
                <h2>Panampilly Nagar</h2>
            </div>
            <div class="loc-add">26/2324, Sunshine Avenue, Golden Gardens, Panampally Nagar, kochi, Kerala 682036, India <br>Contact : +91 9494942336 </div>
        </div>
    </div>
</div>

<div id="fleet" class="fleet">
    <div class="fleet-h">
        <div class="fleet-header">
            <h5>OUR FLEET</h5>
        </div>
    </div>
    <div class="fleet-images">
        <?php
        $sql = "SELECT * FROM bike";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row["is_available"] == 1) {
                    $status = "disabled"; // Bike is not available
                    $link = ""; // No link for disabled bikes
                    $Book = "Not Available";
                    $style = "style = 'filter: grayscale(1);'";
                } else {
                    $status = ""; // Bike is available
                    $link = "href='Booking.php?bikeid={$row["bike_id"]}'";
                    $Book = "Book Now";
                    $style = "";
                }
                echo
                "<div class='fleet-image' >
                        <img src='{$row["img_url"]}' alt='{$row["bike_name"]}' $style>
                        <div class='description'>{$row["bike_name"]}</div>
                       <button type='button' class='book-now' $status $style><a $link>$Book</a></button>
                    </div>
                    ";
            }
        }
        ?>
    </div>
</div>


</body>

</html><?php include('Footer.php'); ?>