<?php
/* Database credentials 
	servername = "localhost"
	username = "root"
	password = ""
	databasename = "portpulse" */
	 
	/* Attempt to connect to MySQL database */
	$link = mysqli_connect("localhost", "root", "", "portpulse");
	 
	// Check connection
	if($link === false){
		die("ERROR! Connection failed.." . mysqli_connect_error());
	}
?>