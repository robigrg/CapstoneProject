<?php
	session_start();

	$table_name	= $_SESSION['table'];
	
	$CurrentName = $_POST['CurrentName'];
	
	$servername = "localhost";
	$username = "Warehouse_Warrior";
	$password = "warehousewarrior";
	
	try{
		$command = "DELETE FROM products WHERE `Item Name`='".$CurrentName."'" ;
		$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');
		$conn->exec($command);
		$response = [
			'success' => true, 
			'message' => $CurrentName . ' has been successfully deleted!'
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