 <?php
	//start the session
	session_start();

	if(!isset($_SESSION['user'])) header('location: login.php');
	$_SESSION['table'] = 'products';
	$user = $_SESSION['user'];

	

		
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
					<h1 class="section_header"><center>Insert New Product</center></h1>
					<div id="addprod_Container">
									<form action="database/addproduct_connection.php" method="POST" class="appForm">
										<div class="appFormInput_Container">
											<label for="ItemName">Item Name:</label>
											<input type="text" class="appFormInput" id="ItemName" name="ItemName"/>
										</div>
										<div class="appFormInput_Container">
											<label for="Category">Category:</label>
											<input type="text" class="appFormInput"id="Category" name="Category"/>
										</div>
										<div class="appFormInput_Container">
											<label for="Quantity">Quantity:</label>
											<input type="text" class="appFormInput"id="Quantity" name="Quantity"/>
										</div>
										<div class="appFormInput_Container">
											<label for="Description">Description:</label>
											<input type="text" class="appFormInput"id="Description" name="Description"/>
										</div>
										<div class="appFormInput_Container">
											<label for="Price">Price:</label>
											<input type="text" class="appFormInput"id="Price" name="Price"/>
										</div>
										<button type="submit" class="addItem_Button"><i class="fa fa-plus "></i> Add Item</button>
									</form>
									<?php 
										if(isset($_SESSION['response'])){ 
											$response_message = $_SESSION['response']['message'];
											$is_success = $_SESSION['response']['success'];
									?>
									<div class="responseMessage">
										<p class="responseMessage <?= $is_success ? 'responseMessage__success' : 'responseMessage__error' ?>" >
											<?= $response_message ?>
										</p>
									</div>
									<?php unset($_SESSION['response']); } ?>
					</div>
					<?php
						echo '<table>
							<tr>
								<th>Item Name</th>
								<th>Item Category</th>
								<th>Item Quantity</th>
								<th>Item Description</th>
								<th>Item Price</th>
								<th>Edit Item</th>
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
									  <td>$'.$ItemPrice.'</td>
									  <td> 
										<form action="editproduct.php" method="POST">
											<input type ="hidden" id="ItemName" name="ItemName" value="'.$ItemName.'"/>
											<button type="submit" class="editItem_Button"><i class="fa fa-plus "></i> Edit</button>
										</form>
									  </td>
								      <tr>';
								}
						}
					?>
					<div class="column column-7">
						<h2>Inventory:</h2>
					</div>
				</div>
			</div>
		</div>	
	</div>
<script src="js/script.js"></script>
</body>
</html>