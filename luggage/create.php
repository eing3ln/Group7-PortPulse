<?php
// Include config file
require_once "connectdB-crudLuggage.php";
 
// Define variables and initialize with empty values
$custname = $luggtype = $weight = $addr = $targetAddr = $mobileNum = $remarks = "";
$custname_err = $luggtype_err = $weight_err = $addr_err = $targetAddr_err = $mobileNum_err = $remarks_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Customer Name
    $input_custname = trim($_POST["custname"]);
    if(empty($input_custname)) {
        $custname_err = "Please enter Customer name.";
    } else {
        $custname = $input_custname;
    }

    // Validate Luggage Type
    $input_luggtype = trim($_POST["luggtype"]);
    if(empty($input_luggtype)) {
        $luggtype_err = "Please enter Luggage Type.";
    } else {
        $luggtype = $input_luggtype;
    }

    // Validate Weight
    $input_weight = trim($_POST["weight"]);
    if(empty($input_weight)) {
        $weight_err = "Please enter weight of luggage.";     
    } else {
        $weight = $input_weight;
    }

    // Validate Home Address
    $input_addr = trim($_POST["addr"]);
    if(empty($input_addr)) {
        $addr_err = "Please enter Home Address.";
    } else {
        $addr = $input_addr;
    }

    // Validate Target Destination Address
    $input_targetAddr = trim($_POST["targetAddr"]);
    if(empty($input_targetAddr)) {
        $targetAddr_err = "Please enter Target Destination Address.";
    } else {
        $targetAddr = $input_targetAddr;
    }

    // Validate Mobile Number
    $input_mobileNum = trim($_POST["mobileNum"]);
    if(empty($input_mobileNum)) {
        $mobileNum_err = "Please enter your Mobile Number.";     
    } else {
        $mobileNum = $input_mobileNum;
    }

    // Validate Remarks
    $input_remarks = trim($_POST["remarks"]);
    if(empty($input_remarks)) {
        $remarks_err = "Please enter Target Destination Address.";
    } else {
        $remarks = $input_remarks;
    }

    // Check input errors before inserting in database
    if(empty($custname_err) && empty($luggtype_err) && empty($weight_err) && empty($date_err) && empty($addr_err) && empty($targetAddr_err) && empty($mobileNum_err) && empty($remarks_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO luggage (custname, luggtype, weight, addr, targetAddr, mobileNum, remarks, ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssissisi", $param_custname, $param_luggtype, $param_weight, $param_addr, $param_targetAddr, $param_mobileNum, $param_remarks, $param_ID);
            
            // Set parameters
            $param_custname = $custname;
            $param_luggtype = $luggtype;
            $param_weight = $weight;
            $param_addr = $addr;
            $param_targetAddr = $targetAddr;
            $param_mobileNum = $mobileNum;
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
              <li><a class="dropdown-item" href="/PortPulse/index.html">Sign out</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="/PortPulse/register.php">Add Admin Employee</a></li>
            </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Create Operation for Luggage -->
<header class="w3-container w3-teal w3-center" style="padding:26px 16px">
  <h1 class="w3-margin w3-jumbo">ADD LUGGAGE PAGE</h1>
</header>

<div class="w3-row-padding w3-padding-36 w3-container">
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Add Luggage</h2>
                    <p>Kindly fill out the required information.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" name="custname" class="form-control <?php echo (!empty($custname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $custname; ?>">
                            <span class="invalid-feedback"><?php echo $custname_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Luggage Type</label>
                            <input type="text" name="luggtype" placeholder="Check in/Hand carry" class="form-control <?php echo (!empty($luggtype_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $luggtype; ?>">
                            <span class="invalid-feedback"><?php echo $luggtype_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Weight (kg)</label>
                            <input type="text" name="weight" class="form-control <?php echo (!empty($weight_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $weight; ?>">
                            <span class="invalid-feedback"><?php echo $weight_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Home Address</label>
                            <input type="text" name="addr" class="form-control <?php echo (!empty($addr_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $addr; ?>">
                            <span class="invalid-feedback"><?php echo $addr_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Target Destination Address</label>
                            <input type="text" name="targetAddr" class="form-control <?php echo (!empty($targetAddr_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $targetAddr; ?>">
                            <span class="invalid-feedback"><?php echo $targetAddr_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" name="mobileNum" class="form-control <?php echo (!empty($mobileNum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mobileNum; ?>">
                            <span class="invalid-feedback"><?php echo $mobileNum_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Remarks</label>
                            <input type="text" name="remarks" class="form-control <?php echo (!empty($remarks_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $remarks; ?>">
                            <span class="invalid-feedback"><?php echo $remarks_err;?></span>
                        </div><br><br>

                        <input type="submit" class="btn btn-success" value="Submit">
                        <a href="crud-index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div><br><br>

<!-- Footer -->
<footer class="footer">
  <h4 class="footer-dev">Developed by: <h4 class="footer-name">Naguit | Isidro | Opena | Fisalbon | Camus | Aquino</h4></h4>
</footer>

</div>

</body>
</html>