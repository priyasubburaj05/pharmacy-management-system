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


$sql = "SELECT * FROM drugs WHERE availability='yes'"; 
if ($res = mysqli_query($link, $sql)) { 
    if (mysqli_num_rows($res) > 0) { 
        echo "<table>"; 
        echo "<tr>"; 
        echo "<th>DRUG</th>"; 
        echo "<th>DESCRIPTION</th>"; 
        echo "<th>AVAILABLITY</th>"; 
        echo "</tr>"; 
        while ($row = mysqli_fetch_array($res)) { 
            echo "<tr>"; 
            echo "<td>".$row['drug_name']."</td>"; 
            echo "<td>".$row['description']."</td>"; 
            echo "<td>".$row['availability']."</td>"; 
            echo "</tr>"; 
        } 
        echo "</table>"; 
        
    } 
    else { 
        echo "NO DRUGS AVAILABLE NOW DUE TO CORONA."; 
    } 
} 
else { 
    echo "ERROR: Could not able to execute $sql. "
                                .mysqli_error($link); 
} 
mysqli_close($link); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DRUG LIST</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<p>
   <a href="welcome.php" class="btn btn-danger">GO BACK</a>
    </p>
</body>
</html>