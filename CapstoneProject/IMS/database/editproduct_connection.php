<?php
	session_start();

	$table_name	= $_SESSION['table'];
	
	$CurrentName = $_POST['CurrentName'];
	$ItemName = $_POST['ItemName'];
	$Category = $_POST['Category'];
	$Quantity = $_POST['Quantity'];
	$Description = $_POST['Description'];
	$Price = $_POST['Price'];


	$servername = "localhost";
	$username = "Warehouse_Warrior";
	$password = "warehousewarrior";

	
	try{
		$query = "SELECT * FROM products WHERE `Item Name`='".$CurrentName."'";
		$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');

		$stmt = $conn->prepare($query);
		$stmt->execute();
		$row = $stmt->fetch();


		if($ItemName == ''){
			$ItemName = $row['Item Name'];
			}
		if($Category == ''){
			$Category = $row['Item Category'];
			}
		if($Quantity == ''){
			$Quantity = $row['Item Quantity'];
			}
		if($Description == ''){
			$Description = $row['Item Description'];
			}
		if($Price == ''){
			$Price = $row['Item Price'];
			}

		$command = "UPDATE $table_name SET `Item Name`='".$ItemName."',`Item Category`='".$Category."',`Item Quantity`='".$Quantity."',`Item Description`='".$Description."', `Item Price`='".$Price."' WHERE `Item Name`='".$CurrentName."'" ;


		$conn->exec($command);
		$response = [
			'success' => true, 
			'message' => $ItemName . ' has been successfully edited!'
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