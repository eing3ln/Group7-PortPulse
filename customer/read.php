<?php
// Check existence of ID parameter before processing further
if(isset($_GET["ID"]) && !empty(trim($_GET["ID"]))){
    
    // Include config file
    require_once "connectdB-crudCustomer.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM customer WHERE ID = ?";
    
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
                $fName = $row["fName"];
                $bday = $row["bday"];
                $email = $row["email"];
                $mobileNum = $row["mobileNum"];
                $nationality = $row["nationality"];
                $religion = $row["religion"];
                $addtype = $row["addtype"];
                $addr = $row["addr"];
                $city = $row["city"];
                $state = $row["state"];
                $country = $row["country"];
                $zip = $row["zip"];

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
<div class="w3-top">
  <div class="w3-bar w3-white w3-padding w3-card" id="myNavbar">
    <a href="index.html" class="w3-bar-item w3-button w3-wide"><b>PortPulse</b></a>
  
<!-- Right-sided navbar links -->
<div class="w3-right w3-hide-small">
  <a href="create.php" class="w3-bar-item w3-button w3-teal">BOOK NOW</a>
  <a href="/PortPulse/about.html" class="w3-bar-item w3-button">ABOUT US</a>
  <a href="/PortPulse/track.html" class="w3-bar-item w3-button">TRACK</a>
  <a href="/PortPulse/developers.html" class="w3-bar-item w3-button">DEVELOPER</a>
  <a href="/PortPulse/contact.php" class="w3-bar-item w3-button">CONTACT</a>
  <a href="/PortPulse/login.php" class="w3-bar-item w3-button">ADMIN LOGIN</a>
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
  <a href="/PortPulse/index.html" onclick="w3_close()" class="w3-bar-item w3-button w3-wide"><b>PortPulse</b></a>
  <a href="create.php" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-suitcase" style="color: #435650;"></i>     BOOK NOW</a>
  <a href="/PortPulse/about.html" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-question" style="color: #435650;"></i>     ABOUT US</a>
  <a href="/PortPulse/track.html" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-plane" style="color: #435650;"></i>     TRACK</a>
  <a href="/PortPulse/developers.html" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-user" style="color: #435650;"></i>     DEVELOPER</a>
  <a href="/PortPulse/contact.php" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-envelope" style="color: #435650;"></i>     CONTACT</a>
  <a href="/PortPulse/login.php" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-address-card" style="color: #435650;"></i>     ADMIN LOGIN</a>
</nav>

<!-- Read Operation for Customers -->
<header class="w3-container w3-teal w3-center" style="padding:26px 16px">
  <h1 class="w3-margin w3-jumbo">VIEW CUSTOMER DETAILS</h1>
</header>

<div class="w3-row-padding w3-padding-36 w3-container">
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Full Name</label>
                        <p><b><?php echo $row["fName"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Date of Birth</label>
                        <p><b><?php echo $row["bday"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $row["email"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Mobile Number</label>
                        <p><b><?php echo $row["mobileNum"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Nationality</label>
                        <p><b><?php echo $row["nationality"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Address Type</label>
                        <p><b><?php echo $row["addtype"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Home Address</label>
                        <p><b><?php echo $row["addr"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <p><b><?php echo $row["city"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>State/Province/Region</label>
                        <p><b><?php echo $row["state"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Country</label>
                        <p><b><?php echo $row["country"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>ZIP/Postal Code</label>
                        <p><b><?php echo $row["zip"]; ?></b></p>
                    </div>

                    <button onclick="window.print()" class="btn btn-success">Print</button>
                    <button type="button" id="sendToEmail" class="btn btn-primary">Send to Email</button>
                    <a href="crud-index.php" class="btn btn-secondary">Back</a><br><br>
                </div>
            </div>        
        </div>
    </div>

<!-- Footer -->
<footer class="footer">
  <h4 class="footer-dev">Developed by: <h4 class="footer-name">Naguit | Isidro | Opena | Fisalbon | Camus | Aquino</h4></h4>
</footer>

</script>
</body>
</html>