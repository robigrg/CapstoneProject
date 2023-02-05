<?php
	session_start();

	$table_name	= $_SESSION['table'];
	

	$BuyerName = $_POST['BuyerName'];
	$ItemName = $_POST['ItemName'];
	$Category = $_POST['Category'];
	$Quantity = $_POST['Quantity'];
	$Description = $_POST['Description'];
	$Price = $_POST['Price'];
	
	$servername = "localhost";
	$username = "Warehouse_Warrior";
	$password = "warehousewarrior";
	
	try{
		$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');

		$query = "SELECT * FROM products WHERE `Item Name`='".$ItemName."'";
		$stmt = $conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch();

		$ItemName = $row['Item Name'];
		$Category = $row['Item Category'];
		$Quantity = $row['Item Quantity'];
		$Description = $row['Item Description'];
		$Price = $row['Item Price'];


		$command = "DELETE FROM products WHERE `Item Name`='".$ItemName."'" ;

		$conn->exec($command);

		
		$command2 = "INSERT INTO $table_name(`Buyer Name`,`Item Name`, `Item Category`, `Item Quantity`, `Item Description`, `Item Price`, `Date Ordered`) VALUES ('".$BuyerName."','".$ItemName."', '".$Category."', '".$Quantity."', '".$Description."', '".$Price."', CURRENT_TIMESTAMP)";
		
		$conn->exec($command2);

		$response = [
			'success' => true, 
			'message' => $ItemName . ' has been ordered successfully!'
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