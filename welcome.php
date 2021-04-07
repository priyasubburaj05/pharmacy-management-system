<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
if(!isset($_SESSION["username"]) || $_SESSION["username"] !== "admin"){
    header("location: welcome1.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to DPS Pharmacy.</h1>
    </div>
<p>
<a href="drugs.php">DRUGS AVAILABLE</a>.</p>
<p>
<a href="stock.php">STOCK</a>.</p>
<p>
<a href="management.php">MANAGEMENT</a>.</p>
<p>
<a href="customer.php">CUSTOMERS</a>.</p>
<p>
<a href="prescriptions.php">PRESCRIPTIONS</a>.</p>
<p>
<a href="receipts.php">VIEW RECEIPTS</a>.</p> 


<p>
<a href="reset.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
  </p>
</body>
</html>