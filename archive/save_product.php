<?php
	require_once 'conn.php';
 
	if(ISSET($_POST['save'])){
		$product_code = $_POST['product_code'];
		$product_name = $_POST['product_name'];
		$description = $_POST['description'];
		$due_date = $_POST['due_date'];
 
		$insert = mysqli_query($conn, "INSERT INTO product VALUES('', '$product_code', '$product_name', '$description', '$due_date')") or die(mysqli_error($conn));
		if($insert)
		header("location: index.php");
	}
?>