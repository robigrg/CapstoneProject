<?php
	//start the session
	session_start();

	if(isset($_SESSION['user'])) header('location: dashboard.php');

	include'connection.php';
	$connect_error = '';
	if($_POST){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$query = 'SELECT * FROM users WHERE users.email = "'. $username .'" AND users.password	= "'. $password .'"';
		$stmt = $conn->prepare($query);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$user = $stmt->fetchAll()[0];
			$_SESSION['user'] = $user;
			header('Location: dashboard.php');

		}else $connect_error = 'Please make sure that the username and password is correct.';
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Warehouse Warrior IMS Login - Inventory Management System</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body id="Login-Body">
	<?php if(!empty($connect_error)) { ?>
		<div id="errorMessage">
			<strong>ERROR:</strong><p> <?= $connect_error ?> </p>
		</div>
	<?php } ?>
	<div class="container">
		<div class="Login-Header">
			<h1>WAREHOUSE WARRIOR</h1>
			<h2>INVENTORY MANAGEMENT SYSTEM</h2>
		</div>
		<div class="Login-Body">
			<form action="login.php" method="POST">
				<div class="LoginInputContainer">
					<label for="">Username:</label>
					<input placeholder="username" name="username" type="text" />
				</div>
				<div class="LoginInputContainer">
					<label for="">Password:</label>
					<input placeholder="password" name="password" type="password" />
				</div>
				<div class="LoginButtonContainer">
					<button>LOGIN</button>
				</div>
				
			</form>
			
		</div>
	</div>
</body>
</html>