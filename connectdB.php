<?php
/* Database credentials 
	servername = "localhost"
	username = "root"
	password = ""
	databasename = "portpulse" */

	// Database connection
	$conn = mysqli_connect("localhost","root","","portpulse");

	if(!$conn) {
		die("Connection Failed!");
	}

	else {
		echo "Connection is Successful! Directing to your Database now..";
	}
?>