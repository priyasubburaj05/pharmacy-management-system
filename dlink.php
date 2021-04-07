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




$query = "SELECT * FROM drugs WHERE drug_name='$_SESSION[drug_name]'"; 
if($result = mysqli_query($link, $query)){
if(mysqli_num_rows($result)==0){
echo'This drug is not available ,SORRY';
}
if(mysqli_num_rows($result)>0){
echo ' This drug exists ;)';
}}
mysqli_close($link); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AVAILABILITY</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<p>
   <a href="process.php" class="btn btn-danger">PROCEED</a>
   <a href="welcome.php" class="btn btn-danger">GO BACK</a>
    </p>
</body>
</html>