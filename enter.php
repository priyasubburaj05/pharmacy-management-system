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
$cust_name = $Age = $sex =$address= $Phone=$date ="";
$cust_name_err = $Age_err = $sex_err=$address_err= $Phone_err = $date_err= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate cust_name
    if(empty(trim($_POST["cust_name"]))){
        $cust_name_err = "Please enter a cust_name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM prescription WHERE cust_name = ?";
        
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
                    $cust_name_err = "enter your full name.";
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
    
    // Validate Age
    if(empty(trim($_POST["Age"]))){
        $Age_err = "Please enter a Age.";     
    } else{
        $Age = trim($_POST["Age"]);
    }
     if(empty(trim($_POST["sex"]))){
        $sex_err = "Please enter a sex.";     
    } else{
        $sex = trim($_POST["sex"]);
    }
 if(empty(trim($_POST["address"]))){
        $address_err = "Please enter a address.";     
    } else{
        $address = trim($_POST["address"]);
    }
 if(empty(trim($_POST["Phone"]))){
        $Phone_err = "Please enter a Phone.";     
    } else{
        $Phone = trim($_POST["Phone"]);
    }
 if(empty(trim($_POST["date"]))){
        $date_err = "Please enter a date.";     
    } else{
        $date = trim($_POST["date"]);
    }

$_SESSION["date"]=$date;

    
    // Check input errors before inserting in database
    if(empty($cust_name_err) && empty($Age_err) && empty($sex_err) && empty($address_err) && empty($Phone_err) && empty($date_err)){
        
        // Prepare an insert statement
      
         
        $stmt=mysqli_stmt_init($link);
        if(mysqli_stmt_prepare($stmt, "INSERT INTO prescription (cust_name, Age,sex, address,Phone, date) VALUES (?, ?,?,?,?,?)")){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sissss", $param_cust_name, $Age,$sex, $address,$Phone, $date);
            
   
            
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
    <title>DETAILS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>DETAILS</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($cust_name_err)) ? 'has-error' : ''; ?>">
                <label>cust_name</label>
                <input type="text" name="cust_name" class="form-control" value="<?php echo $cust_name; ?>">
                <span class="help-block"><?php echo $cust_name_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($Age_err)) ? 'has-error' : ''; ?>">
                <label>Age</label>
                <input type="text" name="Age" class="form-control" value="<?php echo $Age; ?>">
                <span class="help-block"><?php echo $Age_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($sex_err)) ? 'has-error' : ''; ?>">
                <label>sex</label>
                <input type="text" name="sex" class="form-control" value="<?php echo $sex; ?>">
                <span class="help-block"><?php echo $sex_err; ?></span>
            </div>
             <div class="form-group <?php echo (!empty($address_err)) ? 'has-error' : ''; ?>">
                <label>address</label>
                <input type="text" name="address" class="form-control" value="<?php echo $address; ?>">
                <span class="help-block"><?php echo $address_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($Phone_err)) ? 'has-error' : ''; ?>">
                <label>Phone</label>
                <input type="text" name="Phone" class="form-control" value="<?php echo $Phone; ?>">
                <span class="help-block"><?php echo $Phone_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                <label>date</label>
                <input type="text" name="date" class="form-control" value="<?php echo $date; ?>">
                <span class="help-block"><?php echo $date_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p> <a href="predetails.php">PROCEED</a>.</p>
        </form>
    </div>    
</body>
</html>

