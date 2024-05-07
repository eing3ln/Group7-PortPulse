<!DOCTYPE html>
<?php require 'archive_query.php'?>
<html lang="en">
	<head>
		<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
	</head>
<body>

	<!-- <div class="col-md-3"></div> -->
	<div class="col-md-6 well">
		<h3 class="text-primary">PortPulse - Auto Archive Data</h3>
        <a href="archive.php" class="pull-right">Archive</a>
	</div>

	<div class="modal fade" id="form_modal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">

				<form method="POST" action="save_product.php">
					<div class="modal-header">
						<h3 class="modal-title">Device Details</h3>
					</div>

            <!-- INSERT FORM HERE -->

					<div class="modal-body">
						<div class="col-md-2"></div>
						<div class="col-md-8">
							<div class="form-group">
								<label>ID Code</label>
								<input type="text" name="product_code" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Device Number</label>
								<input type="text" name="product_name" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Description</label>
								<input type="text" name="description" class="form-control" required="required" />
								</div>
							<div class="form-group">
								<label>Date Archived</label>
								<input type="date" name="due_date" class="form-control" required="required" />
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button name="save" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
					</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>	
</html>