<?php
	session_start();
	echo "Logged out successfully";
	session_unset(); //removing all the session variables
	
	session_destroy(); //stop the session
	
	header('location: ../index.php');
?>