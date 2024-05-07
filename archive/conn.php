<?php
	$conn = mysqli_connect("localhost", "root", "", "portpulse");
 
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>