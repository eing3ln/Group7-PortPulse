<!DOCTYPE html>
<?php require 'archive_query.php'?>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>
	<div class="col-md-3"></div>
	<div class="col-md-6 well">
		<h3 class="text-primary">PHP - Simple Auto Archive Data</h3>
		<hr style="border-top:1px dotted #ccc;"/>
		<a href="index.php" class="pull-right">Main Page</a>
		<br /><br />
		<table class="table table-bordered">
			<thead class="alert-info">
				<tr>
					<th>ID Code</th>
					<th>Device Number</th>
					<th>Description</th>
					<th>Date Saved</th>
				</tr>
			</thead>
			<tbody style="background-color:#fff;">
				<?php
					require 'conn.php';
 
					$query = mysqli_query($conn, "SELECT * FROM archive") or die(mysqli_error($conn));
					while($fetch = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $fetch['product_code']?></td>
					<td><?php echo $fetch['product_name']?></td>
					<td><?php echo $fetch['description']?></td>
					<td><?php echo $fetch['date_archived']?></td>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
</body>	
</html>