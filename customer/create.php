<?php
// Include config file
require_once "connectdB-crudCustomer.php";
 
// Define variables and initialize with empty values
$fName = $bday = $email = $mobileNum = $nationality = $targetAddr = $addtype = $addr = $city = $state = $country = $zip = "";
$fName_err = $bday_err = $email_err = $mobileNum_err = $nationality_err = $targetAddr_err = $addtype_err = $addr_err = $city_err = $state_err = $country_err = $zip_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate Full name
    $input_name = trim($_POST["fName"]);
    if(empty($input_name)) {
        $fName_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $fName_err = "Please enter a valid name.";
    } else {
        $fName = $input_name;
    }

    // Validate Birth date
    $input_bday = trim($_POST["bday"]);
    if(empty($input_bday)) {
        $bday_err = "Please enter your Birth date.";
    } else {
        $bday = $input_bday;
    }

    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter your email.";     
    } else{
        $email = $input_email;
    }

    // Validate Mobile Number
    $input_mobileNum = trim($_POST["mobileNum"]);
    if(empty($input_mobileNum)) {
        $mobileNum_err = "Please enter your Mobile Number.";     
    } else {
        $mobileNum = $input_mobileNum;
    }

    // Validate Nationality
    $input_nationality = trim($_POST["nationality"]);
    if(empty($input_nationality)) {
        $nationality_err = "Please enter your nationality.";
    } else {
        $nationality = $input_nationality;
    }

    // Validate Target Destination Address
    $input_targetAddr = trim($_POST["targetAddr"]);
    if(empty($input_targetAddr)) {
        $targetAddr_err = "Please enter Target Destination Address.";
    } else {
        $targetAddr = $input_targetAddr;
    }

    // Validate Address Type
    $input_addtype = trim($_POST["addtype"]);
    if(empty($input_addtype)) {
        $addtype_err = "Please enter your Address type.";
    } else {
        $addtype = $input_addtype;
    }

    // Validate Home Address
    $input_addr = trim($_POST["addr"]);
    if(empty($input_addr)) {
        $addr_err = "Please enter your Home Address.";
    } else {
        $addr = $input_addr;
    }

    // Validate City
    $input_city = trim($_POST["city"]);
    if(empty($input_city)) {
        $city_err = "Please enter what City.";
    } else {
        $city = $input_city;
    }

    // Validate State
    $input_state = trim($_POST["state"]);
    if(empty($input_state)) {
        $state_err = "Please enter what State//Province/Region.";
    } else {
        $state = $input_state;
    }

    // Validate Country
    $input_country = trim($_POST["country"]);
    if(empty($input_country)) {
        $country_err = "Please enter what Country.";
    } else {
        $country = $input_country;
    }

    // Validate ZIP code
    $input_zip = trim($_POST["zip"]);
    if(empty($input_zip)) {
        $zip_err = "Please enter ZIP/Postal code.";     
    } elseif(!ctype_digit($input_zip)) {
        $zip_err = "Please enter a positive integer value.";
    } else {
        $zip = $input_zip;
    } 

    
    // Check input errors before inserting in database
    if(empty($fName_err) && empty($bday_err) && empty($email_err) && empty($mobileNum_err) && empty($nationality_err) && empty($targetAddr_err) && empty($addtype_err) && empty($addr_err) && empty($city_err) && empty($state_err) && empty($country_err) && empty($zip_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO customer (fName, bday, email, mobileNum, nationality, targetAddr, addtype, addr, city, state, country, zip, ID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssisssssssii", $param_fName, $param_bday, $param_email, $param_mobileNum, $param_nationality, $param_targetAddr, $param_addtype, $param_addr, $param_city, $param_state, $param_country, $param_zip, $param_ID);
            
            // Set parameters
            $param_fName = $fName;
            $param_bday = $bday;
            $param_email = $email;
            $param_mobileNum = $mobileNum;
            $param_nationality  = $nationality;
            $param_targetAddr  = $targetAddr;
            $param_addtype = $addtype;
            $param_addr = $addr;
            $param_city = $city;
            $param_state = $state;
            $param_country = $country;
            $param_zip = $zip;
            $param_ID = null;
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {

                // Close statement
                mysqli_stmt_close($stmt);

                // Close connection
                mysqli_close($link);

            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
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
    <a href="/PortPulse/index.html" class="w3-bar-item w3-button w3-wide"><b>PortPulse</b></a>
  
<!-- Right-sided navbar links -->
<div class="w3-right w3-hide-small">
  <a href="create.php" class="w3-bar-item w3-button w3-teal">BOOK NOW</a>
  <a href="/PortPulse/about.html" class="w3-bar-item w3-button">ABOUT US</a>
  <a href="/PortPulse/track.html" class="w3-bar-item w3-button">TRACK</a>
  <a href="/PortPulse/developers.html" class="w3-bar-item w3-button">DEVELOPER</a>
  <a href="/PortPulse/contact.html" class="w3-bar-item w3-button">CONTACT</a>
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
  <a href="/PortPulse/contact.html" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-envelope" style="color: #435650;"></i>     CONTACT</a>
  <a href="/PortPulse/login.php" onclick="w3_close()" class="w3-bar-item w3-button"><i class="fa fa-address-card" style="color: #435650;"></i>     ADMIN LOGIN</a>
</nav>

<!-- Create Operation for Customers -->
<header class="w3-container w3-teal w3-center" style="padding:48px 16px">
  <h1 class="w3-margin w3-jumbo">BOOK NOW USING PORTPULSE</h1>
</header>

<div class="w3-row-padding w3-padding-36 w3-container">
    <div class="dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Book Now</h2>
                    <p>Kindly fill out the required information.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" id="fName" name="fName" placeholder="Enter Full Name" class="form-control <?php echo (!empty($fName_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fName; ?>">
                            <span class="invalid-feedback"><?php echo $fName_err;?></span>
                        </div><br>
        
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="text" id="bday" name="bday" placeholder="YYYY-MM-DD" class="form-control <?php echo (!empty($bday_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bday; ?>">
                            <span class="invalid-feedback"><?php echo $bday_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="email" name="email" placeholder="Enter email address" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Mobile Number</label>
                            <input type="text" id="mobileNum" name="mobileNum" placeholder="Enter your 11 digits numbers" class="form-control <?php echo (!empty($mobileNum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mobileNum; ?>">
                            <span class="invalid-feedback"><?php echo $mobileNum_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Nationality</label>
                            <input type="text" id="nationality" name="nationality" class="form-control <?php echo (!empty($nationality_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nationality; ?>">
                            <span class="invalid-feedback"><?php echo $nationality_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Target Destination Address</label>
                            <input type="text" name="targetAddr" placeholder="City, Country" class="form-control <?php echo (!empty($targetAddr_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $targetAddr; ?>">
                            <span class="invalid-feedback"><?php echo $targetAddr_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Address Type</label>
                            <input type="text" id="addtype" name="addtype" placeholder="Temporary/Permanent" class="form-control <?php echo (!empty($addtype_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $addtype; ?>">
                            <span class="invalid-feedback"><?php echo $addtype_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Home Address</label>
                            <input type="text" id="addr" name="addr" class="form-control <?php echo (!empty($addr_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $addr; ?>">
                            <span class="invalid-feedback"><?php echo $addr_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>City</label>
                            <input type="text" id="city" name="city" class="form-control <?php echo (!empty($city_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $city; ?>">
                            <span class="invalid-feedback"><?php echo $city_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>State/Province/Region</label>
                            <input type="text" id="state" name="state" class="form-control <?php echo (!empty($state_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $state; ?>">
                            <span class="invalid-feedback"><?php echo $state_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>Country</label>
                            <input type="text" id="country" name="country" class="form-control <?php echo (!empty($country_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $country; ?>">
                            <span class="invalid-feedback"><?php echo $country_err;?></span>
                        </div><br>

                        <div class="form-group">
                            <label>ZIP/Postal Code</label>
                            <input type="text" id="zip" name="zip" class="form-control <?php echo (!empty($zip_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $zip; ?>">
                            <span class="invalid-feedback"><?php echo $zip_err;?></span>
                        </div><br><br>

                        <input type="submit" class="btn btn-success" value="Submit">
                        <a href="/PortPulse/index.html" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div><br><br>

<!-- Footer -->
<footer class="footer">
    <h4 class="footer-dev">Developed by: <h4 class="footer-name">Naguit | Isidro | Opena | Fisalbon | Camus | Aquino</h4></h4>
</footer>

<!-- JavaScript External files -->
<script src="https://smtpjs.com/v3/smtp.js"></script>
<script src="javascript/script-contact.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>