<?php include('db_conn.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="style/Signup.css">
	<link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
</head>
<body>
	<div class="wrapper">
		<form action="" method="POST">
			<h1>Register</h1>

			<div class="input-group">
				<div class="input-box">
					<label>Name :</label>
					<input type="text" name="name" placeholder="Ethan Hunt" required>
					<i class='bx bxs-user'></i>
				</div>
			</div>

			<div class="input-group">
				<div class="input-box">
					<label>UserName :</label>
					<input type="text" name="username" placeholder="Ethan_9110" required>
					<i class='bx bx-user'></i>
				</div>
				<div class="input-box">
					<label>Password :</label>
					<input type="password" name="password" placeholder="Hunt@123!" required>
					<i class='bx bxs-lock-alt'></i>
				</div>
			</div>

			<div class="input-box">
				<label>Email :</label>
				<input type="email" name="email" required placeholder="EthanHunt46@gamil.com" id="email">
				<i class='bx bxs-envelope'></i>
				</div>

			<div class="input-box">
				<label>Driving Licence no :</label>
				<input type="text" name="licence" required placeholder="KL41 12345678910" id="dlno">
				<i class='bx bxs-id-card'></i>			
			</div>

			<div class="input-box">
				<label>Phone Number :</label>
				<input type="number" name="phone" required placeholder="9876543210">
				<i class='bx bxs-phone'></i>
			</div>

			<div class="input-box">
				<label>Address :</label>
				<input type="text" name="address" required placeholder="123 Main St, City, State, PIN Code">
				<i class='bx bxs-location-plus'></i>			</div>
			<button type="submit" name="submit" class="btn">Register</button>

			<div class="login-link">
				<p>Already have an account ? <a href="Login.php">Log in</a></p>
			</div>
		</form>
	</div>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (isset($_POST["submit"])) {
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email = $_POST['email'];
		$licence = $_POST['licence'];
		$phone = $_POST['phone'];
		$address = $_POST['address'];

		// Store passwords securely by hashing them before storing them in the database. This prevents storing plain text passwords, which can be a security risk if the database is compromised.
		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		//check if the username already exists in the database.
		$chk_username = $conn->query("SELECT * FROM register WHERE user_name = '$username'");
		if ($chk_username->num_rows > 0) {
			// Display an error message if the username already exists
			echo "Username already exits. Please choose a different name.";
		} else {
			//preventing SQL injection attacks, use prepared statements for database queries.
			$stmts = $conn->prepare("insert into register(reg_name,user_name,password,email,licence_no,phone_no,address) values(?, ?, ?, ?, ?, ?, ?)");
			$stmts->bind_param("sssssss", $name, $username, $hashed_password, $email, $licence, $phone, $address);
			// Insert the user data into the database using prepared statements
			if ($stmts->execute()) {
				header("Location: Login.php"); // Redirect to the login page after successful registration

				exit; //no need to run in background.
			} else {
				echo "Error: " . $stmt . "<br>" . mysqli_error($conn);
				$msg = "REGISTRATION FAILED";
				echo $msg;
			}
		}
	}
}
?>