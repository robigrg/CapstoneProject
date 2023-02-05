<?php
	session_start();

	$table_name	= $_SESSION['table'];

	$ItemName = $_POST['ItemName'];
	$Category = $_POST['Category'];
	$Quantity = $_POST['Quantity'];
	$Description = $_POST['Description'];
	$Price = $_POST['Price'];


	$servername = "localhost";
	$username = "Warehouse_Warrior";
	$password = "warehousewarrior";

	
	try{
		$command = "INSERT INTO $table_name(`Item Name`, `Item Category`, `Item Quantity`, `Item Description`, `Item Price`) VALUES ('".$ItemName."', '".$Category."', '".$Quantity."', '".$Description."', '".$Price."')";

		$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');
		$conn->exec($command);
		$response = [
			'success' => true, 
			'message' => $ItemName . ' has been added to the inventory successfully!'
		];
	} catch (PDOException $e){
		$response = [
			'success' => false, 
			'message' => $e->getMessage()
		];
	}

	$_SESSION['response'] = $response;
	header('location: ../addproduct.php');
?>