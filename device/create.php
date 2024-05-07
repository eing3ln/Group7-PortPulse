<?php
// Include config file
require_once "connectdB-crudDevice.php";
 
// Define variables and initialize with empty values
$generatedID = $remarks = "";
$generatedID_err = $remarks_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if generatedID is set in the POST data
      if(isset($_POST['generatedID'])) {
        // Set $generatedID to the value from the form
        $generatedID = $_POST['generatedID'];
    
      } else {
        // Handle the case when generatedID is not set
        $generatedID = "";
      }

    // Validate Remarks
      $input_remarks = trim($_POST["remarks"]);
      if(empty($input_remarks)) {
          $remarks_err = "Please enter a valid Remark.";
      } else {
          $remarks = $input_remarks;
      }

    // Check input errors before inserting in database
    if(empty($remarks_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO device (generatedID, remarks, ID) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssi", $param_generatedID, $param_remarks, $param_ID);
            
            // Set parameters
            $param_generatedID = $generatedID;
            $param_remarks = $remarks;
            $param_ID = $ID;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: crud-index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
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
              <li><a class="dropdown-item" href="/PortPulse/customer/crud-index.php">Customer Reports</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">Device</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="create.php">Add Device</a></li>
              <li><a class="dropdown-item" href="crud-index.php">Device Reports</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">Luggage</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/PortPulse/luggage/create.php">Add Luggage</a></li>
              <li><a class="dropdown-item" href="/PortPulse/luggage/crud-index.php">Customer Luggage Report</a></li>
            </ul>
        </li>

        <li class="nav-item dropdown dropstart text-end">
          <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown">Admin Profile</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/PortPulse/index.html">Sign out</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/PortPulse/register.php">Add Admin Employee</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Create Operation for Device -->
<header class="w3-container w3-teal w3-center" style="padding:26px 16px">
  <h1 class="w3-margin w3-jumbo">ADD DEVICE PAGE</h1>
</header>

<div class="w3-row-padding w3-padding-36 w3-container">
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add Device</h2>
                    <p>Kindly fill out the required information.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    
                      <button type="button" class="btn btn-primary" onclick="generateQR()">Generate QR Code</button><br><br>

                      <div class="form-group">
                        <label>Device ID Number</label><br>
                        <input type="text" id="generatedID" name="generatedID" class="form-control <?php echo (!empty($generatedID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $generatedID; ?>">
                      </div><br>
          
                      <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" name="remarks" class="form-control <?php echo (!empty($remarks_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $remarks; ?>">
                        <span class="invalid-feedback"><?php echo $remarks_err;?></span>
                      </div><br>

                      <input type="submit" class="btn btn-success" value="Submit">
                      <a href="crud-index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>

                <script>
                  // DISPLAYS QR NUMBER
                  function generateQR() {
                    // Generate a random number between 0 and 99999
                    var randomNumber = Math.floor(Math.random() * 100000);
                    // Format the random number as "N-#####"
                    var formattedID = "N-" + padWithZeros(randomNumber, 5);
                    // Set the formatted ID as the value of the input field
                    document.getElementById('generatedID').value = formattedID;
                  }

                  // Helper function to pad number with leading zeros
                  function padWithZeros(num, size) {
                      var padded = num.toString();
                      while (padded.length < size) padded = "0" + padded;
                      return padded;
                  }

                  // Function to copy generated ID to clipboard
                  document.getElementById("deviceForm").addEventListener("submit", function(event) {
                    var generatedID = document.getElementById("generatedID");
                    generatedID.select();
                    document.execCommand("copy");
                    alert("Copied the generated ID: " + generatedID.value);
                  });

                </script>
            </div>        
        </div>
    </div><br><br>

<!-- Footer -->
<footer class="footer">
    <h4 class="footer-dev">Developed by: <h4 class="footer-name">Naguit | Isidro | Opena | Fisalbon | Camus | Aquino</h4></h4>
</footer>

</body>
</html>