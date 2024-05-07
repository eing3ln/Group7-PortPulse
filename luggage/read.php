<?php
// Check existence of ID parameter before processing further
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    
    // Include config file
    require_once "connectdB-crudLuggage.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM luggage WHERE ID = ?";
    
    if($stmt = mysqli_prepare($link, $sql)) {
        
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_ID);
        
        // Set parameters
        $param_ID = trim($_GET["ID"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $custname = $row["custname"];
                $luggtype = $row["luggtype"];
                $weight = $row["weight"];
                $addr = $row["addr"];
                $targetAddr = $row["targetAddr"];
                $mobileNum = $row["mobileNum"];
                $remarks = $row["remarks"];

            } else{
                // URL doesn't contain valid ID parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }


    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);

    } else{
        // URL doesn't contain ID parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>PortPulse</title>
  <link rel="icon" type="image/x-icon" href="logo.png">

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
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
          <a class="nav-link w3-button" href="/PortPulse/home.html">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">Customer</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/PortPulse/customer/create.php">Add Customer</a></li>
              <li><a class="dropdown-item" href="/PortPulse/customer/crud-index.php">Customer Reports</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">Device</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/PortPulse/device/create.php">Add Device</a></li>
              <li><a class="dropdown-item" href="/PortPulse/device/crud-index.php">Device Reports</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">Luggage</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="create.php">Add Luggage</a></li>
              <li><a class="dropdown-item" href="crud-index.php">Customer Luggage Report</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown dropstart text-end">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">Admin Profile</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/PortPulse/update-profile.php">Update Profile</a></li>
              <li><a class="dropdown-item" href="/PortPulse/index.html">Sign out</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/PortPulse/register.php">Add Admin Employee</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Read Operation for Luggage -->
<header class="w3-container w3-teal w3-center" style="padding:26px 16px">
  <h1 class="w3-margin w3-jumbo">VIEW LUGGAGE DETAILS</h1>
</header>

<div class="w3-row-padding w3-padding-36 w3-container">
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Customer Name</label>
                        <p><b><?php echo $row["custname"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Luggage Type</label>
                        <p><b><?php echo $row["luggtype"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Weight</label>
                        <p><b><?php echo $row["weight"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Home Address</label>
                        <p><b><?php echo $row["addr"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Target Destination Address</label>
                        <p><b><?php echo $row["targetAddr"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <p><b><?php echo $row["mobileNum"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Remarks</label>
                        <p><b><?php echo $row["remarks"]; ?></b></p>
                    </div>

                    <button onclick="window.print()" class="btn btn-success">Print</button>
                    <a href="crud-index.php" class="btn btn-secondary">Back</a><br><br>
                </div>
            </div>        
        </div>
    </div>

<!-- Footer -->
<footer class="footer">
  <h4 class="footer-dev">Developed by: <h4 class="footer-name">Naguit | Isidro | Opena | Fisalbon | Camus | Aquino</h4></h4>
</footer>

</div>
</body>
</html>