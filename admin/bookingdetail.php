<?php
include('../db_conn.php');
?>

<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">


	<style type="text/css">
		.abc button {
			width: 350px;
			font-size: 20px;
		}
	</style>
</head>

<body>
	<div align="center" class="bg-dark text-light pt-4 pb-4">
		<a href="logout.php"><button style="float: right;" class="btn btn-danger mr-3">LOGOUT</button></a>
		<a href="admindash.php"><button style="float: left;" class="btn btn-success ml-3">
				<< BACK</button></a>
		<h1>Booking DETAIL</h1>
	</div>

	<table align="center" border="1" width="90%" style="margin-top: 20px;" class="mb-5">
		<tr style="background-color: black; color: white;" align="center">
			<th width="100">User Id</th>
			<th width="150">Bike Id</th>
			<th width="150">Pickup date</th>
			<th width="150">Pickup time</th>
			<th width="180">Dropoff date</th>
			<th width="150">Dropoff time</th>
			<th width="150">Delete</th>
		</tr>

		<?php

		$query = "SELECT * FROM `booked` ";
		$run = mysqli_query($conn, $query);

		if (mysqli_num_rows($run) < 1) {
			echo "<tr><td colspan='5' align='center'>No data found</td><tr>";
		} else {
			while ($data = mysqli_fetch_assoc($run)) {
		?>
				<tr align="center">
					<td> <?php echo $data['reg_id']; ?> </td>
					<td> <?php echo $data['bike_id']; ?> </td>
					<td> <?php echo $data['pickup_date']; ?> </td>
					<td> <?php echo $data['pickup_time']; ?> </td>
					<td> <?php echo $data['dropoff_date']; ?> </td>
					<td> <?php echo $data['dropoff_time']; ?> </td>
					<td><a href="deletebooking.php?bikeid=<?php echo $data['bike_id'] . "&regid=" . $data['reg_id']; ?>">Delete</a></td>
				</tr>
		<?php
			}
		}
		?>
	</table>

	<script src="bootstrap/jss/jquery.min.js"></script>
	<script src="bootstrap/jss/popper.min.js"></script>
	<script src="bootstrap/jss/bootstrap.min.js"></script>
</body>

</html>