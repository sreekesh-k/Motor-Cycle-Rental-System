<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/Header.css">
</head>

<body>

    <body>
        <header>
            <div class="logo-sign">
                <div class="logo"></div>
                <div class="sign">MotorBeam</div>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php#fleet">Fleet</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                    <?php
                    if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        echo
                        "
                    <li><a href = 'userbooking.php'>{$username}'s bookings</a></li>
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
    </body>

</html>