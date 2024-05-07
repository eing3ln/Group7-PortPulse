<!-- Database connection using PHP -->

<?php
	session_start();

	include('connectdB.php');

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$username = $_POST['username'];
		$password = $_POST['pswd'];

		if(!empty($username) && !empty($password)) {
			$query = "SELECT * FROM register WHERE username = ? LIMIT 1";
			$stmt = mysqli_prepare($conn, $query);
			mysqli_stmt_bind_param($stmt, 's', $username);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);

			if($result && mysqli_num_rows($result) > 0) {
				$user_data = mysqli_fetch_assoc($result);

				if($user_data['pswd'] == $password) {
					header("location: home.html");
					die;
				} 
				
				else {
					echo "<script type='text/javascript'> alert('Error! Account is not registered or has incorrect Username or Password.')</script>";
				}
			} 
			
			else {
				echo "<script type='text/javascript'> alert('Error! Account is not registered or has incorrect Username or Password.')</script>";
			}
		}
		
		else {
			echo "<script type='text/javascript'> alert('Error! Account is not registered or has incorrect Username or Password.')</script>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<title>PortPulse</title>
<link rel="icon" type="image/x-icon" href="/PortPulse/images/logo.png">

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>

<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" id="myNavbar">
    <a href="index.html" class="w3-bar-item w3-button w3-wide"><b>PortPulse</b></a>
  
<!-- Right-sided navbar links -->
<div class="w3-right w3-hide-small">
  <a href="/PortPulse/customer/create.php" class="w3-bar-item w3-button w3-teal">BOOK NOW</a>
  <a href="about.html" class="w3-bar-item w3-button">ABOUT US</a>
  <a href="track.html" class="w3-bar-item w3-button">TRACK</a>
  <a href="developers.html" class="w3-bar-item w3-button">DEVELOPER</a>
  <a href="contact.html" class="w3-bar-item w3-button">CONTACT</a>
  <a href="login.php" class="w3-bar-item w3-button">ADMIN LOGIN</a>
</div>
  
<!-- Hide right-floated links on small screens and replace them with a menu icon -->
<a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
  <i class="fa fa-bars"></i>
</a>
</div>
</div>
  
<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-light-grey w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none; z-index: 9999;" id="open_sidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-wide"><b>PortPulse</b></a>
  <a href="/PortPulse/customer/create.php" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-suitcase" style="color: #435650;"></i>     BOOK NOW</a>
  <a href="about.html" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-question" style="color: #435650;"></i>     ABOUT US</a>
  <a href="track.html" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-plane" style="color: #435650;"></i>     TRACK</a>
  <a href="developers.html" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-user" style="color: #435650;"></i>     DEVELOPER</a>
  <a href="contact.html" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-envelope" style="color: #435650;"></i>     CONTACT</a>
  <a href="login.php" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-address-card" style="color: #435650;"></i>     ADMIN LOGIN</a>
</nav>

<!-- Login Section -->
<div class="w3-container w3-teal" style="padding:56px 12px;">
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
    <div class="col col-xl-10">
    <div class="card" style="border-radius: 1rem;">
    <div class="row g-0">
    <div class="col-md-6 col-lg-5 d-none d-md-block">
        <img src="/PortPulse/images/login.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 500px;">
    </div>
    <div class="col-md-6 col-lg-7 d-flex align-items-center">
    <div class="card-body p-4 p-lg-5 text-black">
    
    <h3>LOGIN</h3>
    <form method="POST" action="login.php">
        <div class="form-floating mb-3 mt-3">
            <input type="text" class="form-control" id="username" placeholder="Enter username" name="username" required>
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
            <button class="btn btn-success btn-lg btn-block" type="submit">Login</button>
            <button class="btn btn-dark btn-lg btn-block" type="reset">Reset</button>
        </div>
    </form>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<script>
	// To hide the visibility of the password input to password format
	function myFunction() {
		var x = document.getElementById("pswd");
		if (x.type === "password") {
			x.type = "text";
		}
			
		else {
			x.type = "password";
		}
	}

	// Toggle between showing and hiding the sidebar when clicking the menu icon
    function w3_open() {
      var sidebar = document.getElementById("open_sidebar");
      if (sidebar.style.display === 'block') {
        sidebar.style.display = 'none';
      } else {
        sidebar.style.display = 'block';
      }
    }

    // Close the sidebar with the close button
    function w3_close() {
        var sidebar = document.getElementById("open_sidebar");
        sidebar.style.display = "none";
    }
</script>

</body>
</html>