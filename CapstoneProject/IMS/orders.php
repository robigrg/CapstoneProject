 <?php
	//start the session
	session_start();

	if(!isset($_SESSION['user'])) header('location: login.php');
	$_SESSION['table'] = 'orders';
	$user = $_SESSION['user'];
	$UserName = $user['FirstName']." ".$user['LastName'];

	if(isset($_SESSION['response'])){ 
			$response_message = $_SESSION['response']['message'];
			$is_success = $_SESSION['response']['success'];
	}

	

		
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Warehouse Warrior -  Add Product</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="https://kit.fontawesome.com/a7d13aa081.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
</head>
<body>
	<div id="Dashboard_Main">
		<?php include('sidebar.php') ?>
		<div class="Dashboard_Content_Container" id="Dashboard_Content_Container">
			<?php include('topnav.php') ?>
			<div class="Dashboard_Content">
				<div class="Dashboard_Content_Main">
					<h1 class="section_header"><center>Make An Order</center></h1>
					<?php
						echo '<table>
							<tr>
								<th>Item Name</th>
								<th>Item Category</th>
								<th>Item Quantity</th>
								<th>Item Description</th>
								<th>Item Price</th>
								<th>Order Item</th>
							</tr>';


						$query = 'SELECT * FROM products';
						$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');

						$stmt = $conn->prepare($query);
						$stmt->execute();

						if($stmt->rowCount() > 0){
							while($row = $stmt->fetch()) {
								$ItemName = $row['Item Name'];
								$ItemCat = $row['Item Category'];
								$ItemQuant = $row['Item Quantity'];
								$ItemDesc = $row['Item Description'];
								$ItemPrice = $row['Item Price'];
			
								echo '<tr>
									  <td>'.$ItemName.'</td>
									  <td>'.$ItemCat.'</td>
									  <td>'.$ItemQuant.'</td>
									  <td>'.$ItemDesc.'</td>
									  <td>'.$ItemPrice.'</td>
									  <td> 
										<form action="database/orderproduct_connection.php" method="POST">
											<input type ="hidden" id="ItemName" name="ItemName" value="'.$ItemName.'"/>
											<input type ="hidden" id="BuyerName" name="BuyerName" value="'.$UserName.'"/>
											<button type="submit" class="editItem_Button"><i class="fa fa-plus "></i>Order</button>
										</form>
									  </td>
								      </tr>
									<div class="responseMessage">
										<p class="responseMessage <?= $is_success ? `responseMessage__success` : `responseMessage__error` ?>" >
											<?= $response_message ?>
										</p>
									</div>';
								}
						}
						echo '<table>
							<tr>
								<th>Buyer Name</th>
								<th>Item Name</th>
								<th>Item Category</th>
								<th>Item Quantity</th>
								<th>Item Description</th>
								<th>Item Price</th>
								<th>Date Ordered</th>
								<th>Delivery Status</th>
								<th>Date Delivered</th>
								<th>Confirm Delivery</th>
							</tr>';


						$query = 'SELECT * FROM orders';
						$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');

						$stmt = $conn->prepare($query);
						$stmt->execute();

						if($stmt->rowCount() > 0){
							while($row = $stmt->fetch()) {
								$BuyerName = $row['Buyer Name'];
								$ItemName = $row['Item Name'];
								$ItemCat = $row['Item Category'];
								$ItemQuant = $row['Item Quantity'];
								$ItemDesc = $row['Item Description'];
								$ItemPrice = $row['Item Price'];
								$DateOrdered = $row['Date Ordered'];
								$Delivered = $row['Delivered'];
								if($Delivered == 0)$Delivered = 'Not Delivered';
								else $Delivered = 'Delivered';
								$DateDelivered= $row['Date Delivered'];
			
								echo '<tr>
									  <td>'.$BuyerName.'</td>
									  <td>'.$ItemName.'</td>
									  <td>'.$ItemCat.'</td>
									  <td>'.$ItemQuant.'</td>
									  <td>'.$ItemDesc.'</td>
									  <td>'.$ItemPrice.'</td>
									  <td>'.$DateOrdered.'</td>
									  <td>'.$Delivered.'</td>
									  <td>'.$DateDelivered.'</td>
									  <td>
										<form action="database/deliveredproduct_connection.php" method="POST">
											<input type ="hidden" id="ItemName" name="ItemName" value="'.$ItemName.'"/>
											<input type ="hidden" id="BuyerName" name="BuyerName" value="'.$UserName.'"/>
											<button type="submit" class="editItem_Button"><i class="fa fa-plus "></i>Delivered</button>
										</form>
									  </td>
								      </tr>
									';
									
							}
						}
					?>
