<?php include('db_conn.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
	<link rel="stylesheet" href="style/Login.css">
</head>

<body>
	<div class="wrapper">
		<form action="" method="POST">
			<h1>Login</h1>
			<div class="input-box">
				<input type="text" name="username" placeholder="Username" required>
				<i class='bx bxs-user'></i>
			</div>

			<div class="input-box">
				<input type="password" name="password" placeholder="Password" required>
				<i class='bx bxs-lock-alt'></i>
			</div>
			<button type="submit" name="submit" class="btn">Login</button>

			<div class="register-link">
				<p>Don't have an account ? <a href="Signup.php">Register</a></p>
			</div>
		</form>
		<?php
		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			if (isset($_POST["submit"])) {
				$username = $_POST["username"];
				$password = $_POST["password"];

				// Prepare the SQL statement with a placeholder for the username
				$sql = "SELECT * FROM register WHERE user_name=?";
				$stmt = mysqli_prepare($conn, $sql);

				// Bind the username parameter to the prepared statement
				mysqli_stmt_bind_param($stmt, "s", $username);

				// Execute the prepared statement
				mysqli_stmt_execute($stmt);

				// Get the result of the prepared statement
				$result = mysqli_stmt_get_result($stmt);

				if (mysqli_num_rows($result) > 0) {
					// Fetch the user data
					$row = mysqli_fetch_assoc($result);
					$hashedpassword = $row["password"];
					// Verify the password
					if (password_verify($password, $row["password"])) {
						// Start a new session and store the username in the session variable
						session_start();
						$_SESSION["username"] = $row["user_name"];
						// Redirect to home page after successful login
						header("Location: index.php");
						exit();
					} else {
						// Display an error message if the password is incorrect
						$msg = "<center><h4 style='color:red;'>Invalid Password!</h4></center>";
						echo $msg;
					}
				} else {
					$msg = "<center><h4 style='color:red;'>Invalid Username!</h4></center>";
					echo $msg;
				}
			}
		}
		?>

	</div>
</body>

</html>