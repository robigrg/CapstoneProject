<?php
	session_start();

	$table_name	= $_SESSION['table'];

	$FirstName = $_POST['FirstName'];
	$LastName = $_POST['LastName'];
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$encrypted_password	= password_hash($Password, PASSWORD_DEFAULT);

	$servername = "localhost";
	$username = "Warehouse_Warrior";
	$password = "warehousewarrior";

	
	try{
		$command = "INSERT INTO $table_name(FirstName, LastName, Email, Password, Created, Updated) VALUES ('".$FirstName."', '".$LastName."', '".$Email."', '".$encrypted_password."', NOW(), NOW())";

		$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');
		$conn->exec($command);
		$response = [
			'success' => true, 
			'message' => $FirstName . ' ' . $LastName . ' has been added to the system successfully!'
		];
	} catch (PDOException $e){
		$response = [
			'success' => false, 
			'message' => $e->getMessage()
		];
	}

	$_SESSION['response'] = $response;
	header('location: ../adduser.php');
?>