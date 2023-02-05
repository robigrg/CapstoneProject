 <?php
	//start the session
	session_start();

	if(!isset($_SESSION['user'])) header('location: login.php');
	$_SESSION['table'] = 'products';
	$user = $_SESSION['user'];
	$ItemName = $_POST['ItemName'];

	

		
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
					<?php
					echo '<h1 class="section_header"><center>Edit '.$ItemName.'</center></h1>'
					?>
						<div id="addprod_Container">
								<form action="database/editproduct_connection.php" method="POST" class="appForm">
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
										<?php echo '<input type ="hidden" id="CurrentName" name="CurrentName" value="'.$ItemName.'"/>'?>
									<button type="submit" class="addItem_Button"><i class="fa fa-plus "></i> Confirm Edit</button>
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
							<form action="database/deleteproduct_connection.php" method = "POST" class="appForm">
								<?php echo '<input type ="hidden" id="CurrentName" name="CurrentName" value="'.$ItemName.'"/>'?>
								<label for="DeleteItem">Click Here to Delete This Item:</label>
								<button type="submit" class="addItem_Button"><i class="fa fa-plus "></i> Delete </button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>