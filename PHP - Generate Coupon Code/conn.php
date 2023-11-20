<?php
	$conn = mysqli_connect('localhost', 'root', '', 'db_coupon');
	
	if(!$conn){
		die("Error: Failed to connect to database");
	}
?>