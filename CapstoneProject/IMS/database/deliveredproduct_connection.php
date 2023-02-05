<?php
	session_start();

	$table_name	= $_SESSION['table'];
	
	$BuyerName = $_POST['BuyerName'];
	$ItemName = $_POST['ItemName'];

	$servername = "localhost";
	$username = "Warehouse_Warrior";
	$password = "warehousewarrior";

	try{
		$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');
		
		$command = "UPDATE $table_name SET `Delivered`='1', `Date Delivered`=CURRENT_DATE WHERE `Buyer Name`='".$BuyerName."' AND `Item Name`='".$ItemName."'";
		$stmt= $conn->prepare($command);
		$stmt->execute();

		$response = [
			'success' => true, 
			'message' => $ItemName . ' has been successfully delivered!'
		];
	} catch (PDOException $e){
		$response = [
			'success' => false, 
			'message' => $e->getMessage()
		];
	}

	$_SESSION['response'] = $response;
	header('location: ../orders.php');
?>