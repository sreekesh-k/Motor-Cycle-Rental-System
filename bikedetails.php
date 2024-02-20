<?php
include('db_conn.php');
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        $username = '';
    }
    $id = $_GET["bike_id"];
    // $url = $_GET["url"];
    $sql = "SELECT * FROM bike WHERE bike_id='{$id}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo
            "
            <h1>{$username} YOU SELECTED {$row["bike_name"]}</h1>
            <img src='{$row["img_url"]}' alt='{$row["bike_name"]}' height='500px'>
            ";
        }
    }
}
