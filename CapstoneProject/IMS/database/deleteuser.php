<?php
	$data = $_POST;
	$user_id = (int) $data['user_id'];
	$first_name = $data['f_name'];
	$last_name = $data['l_name'];

	try{
		$command = "DELETE FROM users WHERE id={$user_id}";

		$conn = new PDO("mysql:host=localhost;dbname=inventory_ww", 'root', '');
		
		$conn->exec($command);

		echo json_encode([
			'success' => true,
			'message' => $first_name.' '.$last_name.'successfully deleted!'

		]);
	} catch (PDOException $e){
		echo json_encode([
			'success' => false,
			'message' => 'Error processing your request!'
		]);
	}
?>