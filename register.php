<!-- Database connection using PHP -->

<?php
	session_start();

	include('connectdB.php');

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$fullName = $_POST['fName'];
		$idNumber = $_POST['idNum'];
		$userName = $_POST['username'];
		$password = $_POST['pswd'];

		if(!empty($fullName) && !empty($idNumber) && !empty($userName) && !empty($password)) {
			$query = "INSERT INTO register (fName, idNum, username, pswd) values (?, ?, ?, ?)";
			$stmt = mysqli_prepare($conn, $query);
			mysqli_stmt_bind_param($stmt, 'siss', $fullName, $idNumber, $userName, $password);
			mysqli_stmt_execute($stmt);

			echo "<script type='text/javascript'> alert('Registered Successfully!')</script>";
		}

		else {
			echo "<script type='text/javascript'> alert('Error! Please fill out all required information.')</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PortPulse</title>
  <link rel="icon" type="image/x-icon" href="images/logo.png">

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/portpulse/css/style.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body>

<!-- Navbar (sit on top) -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand w3-wide"><b>PortPulse</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse justify-content-end" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link w3-button" href="home.html">Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown">Customer</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="customer/create.php">Add Customer</a></li>
              <li><a class="dropdown-item" href="customer/crud-index.php">Customer Reports</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown">Device</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="device/create.php">Add Device</a></li>
              <li><a class="dropdown-item" href="device/crud-index.php">Device Reports</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown">Luggage</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="luggage/create.php">Add Luggage</a></li>
              <li><a class="dropdown-item" href="luggage/crud-index.php">Customer Luggage Report</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown dropstart text-end">
            <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">Admin Profile</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.html">Sign out</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="register.php">Add Admin Employee</a></li>
              </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<!-- Registration Section -->
<div class="w3-container w3-teal" style="padding:64px 12px;">
	<div class="container py-5 h-100">
	<div class="row d-flex justify-content-center align-items-center h-100">
	<div class="col col-xl-10">
	<div class="card" style="border-radius: 1rem;">
	<div class="row g-0">
	<div class="col-md-6 col-lg-5 d-none d-md-block">
		<img src="images/register.jpg" alt="register form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 710px;">
	</div>
	<div class="col-md-6 col-lg-7 d-flex align-items-center">
	<div class="card-body p-4 p-lg-5 text-black">
	
	<h3>REGISTER</h3>
	<form method="POST" action="register.php">

		<div class="form-floating mb-3 mt-3">
			<input type="text" class="form-control" id="fName" placeholder="Enter Full Name" name="fName" required>
			<label for="fName">Full Name</label>
		</div>

		<div class="form-floating mb-3 mt-3">
			<input type="text" class="form-control" id="idNum" placeholder="Enter Employee ID Number" name="idNum" required>
			<label for="idNum">Employee ID Number</label>
		</div>

		<div class="form-floating mb-3 mt-3">
			<input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" required>
			<label for="username">Username</label>
		</div>

		<div class="form-floating mb-3 mt-3">
			<input type="password" class="form-control" id="pswd" placeholder="Enter password" name="pswd" required>
			<label for="pswd">Password</label>
		</div>

		<div class="password-checkbox" style="text-align: right; margin-top: 12px;">
			<input type="checkbox" onclick="myFunction()" style="align-right"> Show Password
		</div>

		<div class="pt-1 mb-4">
			<button class="btn btn-success btn-lg btn-block" type="submit">Register</button>
			<button class="btn btn-dark btn-lg btn-block" type="reset">Reset</button>
		</div>
	</form>

	<p>By clicking the Register Button, you agree to our 
		<a href="#">Terms and Condition</a> and <a href="#">Privacy Policy</a>
	</p>
		
	<p>Already have an account? <a href="login.php">Login here</a></p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script>
	function myFunction() {
	  var x = document.getElementById("pswd");
	  if (x.type === "password") {
		x.type = "text";
	  } else {
		x.type = "password";
	  }
	}
</script>

<!-- Footer -->
<footer class="footer">
   <h4 class="footer-dev">Developed by: <h4 class="footer-name">Naguit | Isidro | Opena | Fisalbon | Camus | Aquino</h4></h4>
</footer>

</body>
</html>