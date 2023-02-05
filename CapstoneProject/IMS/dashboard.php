<?php
	//start the session
	session_start();

	if(!isset($_SESSION['user'])) header('location: login.php');

	$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Warehouse Warrior IMS Dashboard - Inventory Management System</title>
    <!-- Stylesheet -->
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="https://kit.fontawesome.com/a7d13aa081.js" crossorigin="anonymous"></script>
</head>
<body>
	<div id="Dashboard_Main">
		<?php include('sidebar.php') ?>
		<div class="Dashboard_Content_Container" id="Dashboard_Content_Container">
			<?php include('topnav.php') ?>
			<div class="Dashboard_Content">
				<div class="Dashboard_Content_Main">
					<main>
						<h1 class="Db">DASHBOARD</h1>
						<div class="date">
							<input type="date">
						</div>
						<div class="insights">
							<div class="sales">
								<span class="fa fa-bar-chart"></span>
								<div class="middle">
									<div class="left">
										<h3>Total Price in Inventory</h3>
									<?php
										$query = 'SELECT * FROM products';
										$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');
										$totalPrice = 0;
										$stmt = $conn->prepare($query);
										$stmt->execute();
										if($stmt->rowCount() > 0){
											while($row = $stmt->fetch()) {
												$ItemQuant = $row['Item Quantity'];
												$ItemPrice = $row['Item Price'];
												$totalPrice = $totalPrice + ($ItemQuant * $ItemPrice);
											}
										}
										echo '
										<h1>$'.$totalPrice.'</h1>'
									?>
									</div>
									<div class="progress">
									</div>
								</div>
								<small class="text-muted">Last 24 Hours</small>
							</div>
							<!--------END OF SALES------->
							<div class="expenses">
								<span class="fas fa-chart-area"></span>
								<div class="middle">
									<div class="left">
									<?php
										$query = 'SELECT * FROM orders WHERE `Delivered`=0';
										$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');
										$totalOrderPrice = 0;
										$stmt = $conn->prepare($query);
										$stmt->execute();
										if($stmt->rowCount() > 0){
											while($row = $stmt->fetch()) {
												$ItemQuant = $row['Item Quantity'];
												$ItemPrice = $row['Item Price'];
												$totalOrderPrice = $totalOrderPrice + ($ItemQuant * $ItemPrice);
											}
										}
										echo '
										<h3>Total Pending Order Income</h3>
										<h1>$'.$totalOrderPrice.'</h1>'
									?>
									</div>
									<div class="progress">
									</div>
								</div>
								<small class="text-muted">Last 24 Hours</small>
							</div>
							<!--------END OF EXPENSES------->
								<div class="income">
								<span class="fas fa-coins"></span>
								<div class="middle">
									<div class="left">
									<?php
										$query = 'SELECT * FROM `orders` WHERE `Delivered`=1';
										$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');
										$totalIncome = 0;
										$stmt = $conn->prepare($query);
										$stmt->execute();
										if($stmt->rowCount() > 0){
											while($row = $stmt->fetch()) {
												$ItemQuant = $row['Item Quantity'];
												$ItemPrice = $row['Item Price'];
												$totalIncome= $totalIncome + ($ItemQuant * $ItemPrice);
											}
										}
										echo '
										<h3>Total Delivered Order Income</h3>
										<h1>$'.$totalIncome.'</h1>'
									?>
									</div>
									<div class="progress">	
									</div>
								</div>
								<small class="text-muted">Last 24 Hours</small>
							</div>
							<!--------END OF INCOME------->
						</div>
					</main>
				</div>
			</div>

		</div>
	</div>

<script src="js/script.js"></script>
</body>
</html>
