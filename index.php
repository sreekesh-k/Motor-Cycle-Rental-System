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

<body>
    <header>
        <div class="logo-sign">
            <div class="logo"></div>
            <div class="sign">MotorBeam</div>
        </div>
        <nav>
            <ul>
                <li><a href="#fleet">Fleet</a></li>
                <li><a href="#contact">Contact</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    echo
                    "
                    <li>$username</li>
                     <li><a href='logout.php'>Logout</a></li>
                    ";
                } else {
                    echo "
                    <li><a href='Signup.php'>Signup</a></li> 
                    <li><a href='login.php'>Login</a></li>
                    ";
                    
                }
                ?>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h1>Welcome to MotorBeam Motorcycle Rental</h1>
        <p>Explore our wide range of motorcycles for rent.</p>
        <a href="#fleet" class="btn">Book Now</a>
    </section>

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
        <h5>OUR FLEET</h5>
        <div class="fleet-images">
            <?php
            $sql = "SELECT * FROM bike";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo
                    "<div class='fleet-image'>
                        <img src='{$row["img_url"]}' alt='{$row["bike_name"]}'>
                        <div class='description'>{$row["bike_name"]}</div>
                        <a href='bikedetails.php?bike_id={$row["bike_id"]}'><div class='book-now'>Book Now</div></a>
                    </div>
                    ";
                }
            }
            ?>
        </div>
    </div>

    <footer id="contact" class="footer">
        <div class="contact-info">
            <p>Contact us:</p>
            <p>Phone: 123-456-7890</p>
            <p>Email: info@motorcyclerental.com</p>
        </div>
        <div class="social-icons">
            <a href="#"><img src="facebook-icon.png" alt="Facebook"></a>
            <a href="#"><img src="twitter-icon.png" alt="Twitter"></a>
            <a href="#"><img src="instagram-icon.png" alt="Instagram"></a>
        </div>
    </footer>
</body>

</html>