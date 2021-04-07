<?php
// Include config file
require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
// Define variables and initialize with empty values
$cust_name = $drug_name = $condition_ =$dose= $quantity=$doctor_name ="";
$cust_name_err = $drug_name_err = $condition__err=$dose_err= $quantity_err = $doctor_name_err= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate cust_name
    if(empty(trim($_POST["cust_name"]))){
        $cust_name_err = "Please enter a cust_name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM prescription_detail WHERE cust_name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_cust_name);
            
            // Set parameters
            $param_cust_name = trim($_POST["cust_name"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $cust_name_err = "This cust_name is already taken.";
                } else{
                    $cust_name = trim($_POST["cust_name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate drug_name
    if(empty(trim($_POST["drug_name"]))){
        $drug_name_err = "Please enter a drug_name.";     
    } else{
        $drug_name = trim($_POST["drug_name"]);

    }
     if(empty(trim($_POST["condition_"]))){
        $condition__err = "Please enter a condition_.";     
    } else{
        $condition_ = trim($_POST["condition_"]);
    }
 if(empty(trim($_POST["dose"]))){
        $dose_err = "Please enter a dose.";     
    } else{
        $dose = trim($_POST["dose"]);
    }
 if(empty(trim($_POST["quantity"]))){
        $quantity_err = "Please enter a quantity.";     
    } else{
        $quantity = trim($_POST["quantity"]);
    }
 if(empty(trim($_POST["doctor_name"]))){
        $doctor_name_err = "Please enter a doctor_name.";     
    } else{
        $doctor_name = trim($_POST["doctor_name"]);
    }
$_SESSION["cust_name"]=$cust_name;
$_SESSION["drug_name"] = $drug_name;
$_SESSION["quantity"] = $quantity;
$_SESSION["doctor_name"] = $doctor_name;


                            

    
    // Check input errors before inserting in database
    if(empty($cust_name_err) && empty($drug_name_err) && empty($condition_err) && empty($condition__err) && empty($dose_err) && empty($doctor_name_err)){
        
        // Prepare an insert statement
      
         
        $stmt=mysqli_stmt_init($link);
        if(mysqli_stmt_prepare($stmt, "INSERT INTO prescription_detail (cust_name, drug_name,condition_, dose,quantity, doctor_name) VALUES (?, ?,?,?,?,?)")){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssis", $param_cust_name, $drug_name,$condition_, $dose,$quantity, $doctor_name);
            
              $param_cust_name=$cust_name;
   
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "succesfully entered";
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PRESCRIPTION DETAIL</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>PRESCRIPTION DETAILS</h2>
        <p>Please fill this form with prescription detail.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($cust_name_err)) ? 'has-error' : ''; ?>">
                <label>cust_name</label>
                <input type="text" name="cust_name" class="form-control" value="<?php echo $cust_name; ?>">
                <span class="help-block"><?php echo $cust_name_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($drug_name_err)) ? 'has-error' : ''; ?>">
                <label>drug_name</label>
                <input type="text" name="drug_name" class="form-control" value="<?php echo $drug_name; ?>">
                <span class="help-block"><?php echo $drug_name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($condition__err)) ? 'has-error' : ''; ?>">
                <label>condition_</label>
                <input type="text" name="condition_" class="form-control" value="<?php echo $condition_; ?>">
                <span class="help-block"><?php echo $condition__err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($dose_err)) ? 'has-error' : ''; ?>">
                <label>dose</label>
                <input type="text" name="dose" class="form-control" value="<?php echo $dose; ?>">
                <span class="help-block"><?php echo $dose_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($quantity_err)) ? 'has-error' : ''; ?>">
                <label>quantity</label>
                <input type="text" name="quantity" class="form-control" value="<?php echo $quantity; ?>">
                <span class="help-block"><?php echo $quantity_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($doctor_name_err)) ? 'has-error' : ''; ?>">
                <label>doctor_name</label>
                <input type="text" name="doctor_name" class="form-control" value="<?php echo $doctor_name; ?>">
                <span class="help-block"><?php echo $doctor_name_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p><a href="dlink.php">PROCEED</a>.</p>
        </form>
    </div>    
</body>
</html>