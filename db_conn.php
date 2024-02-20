<?php 
$servername = "localhost"; //assign the server name to some variable.
$username = "root";
$password = "";
$dbname = "motorcycle_rental";
//mysqli is a class and we are passing parameters to its constructer.
$conn = new mysqli($servername,$username,$password,$dbname);
//conn variable is now an object which has connection to our database.
if ($conn->connect_error) {
    echo "Connection Error" . $conn->connect_error;
}

?>