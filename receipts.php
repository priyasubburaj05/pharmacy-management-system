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

$sql = "SELECT * FROM receipts"; 
if ($res = mysqli_query($link, $sql)) { 
    if (mysqli_num_rows($res) > 0) { 
        echo "<table>"; 
        echo "<tr>"; 
        echo "<th>RECEIPT NO</th>"; 
        echo "<th>PRESCRIPTION-ID</th>"; 
        echo "<th>DRUG</th>"; 
        echo "<th>QUANTITY</th>"; 
        echo "<th>TOTAL</th>"; 
        echo "<th>DATE</th>";
        echo "<th>DOCTOR-NAME</th>";
        echo "</tr>"; 
        while ($row = mysqli_fetch_array($res)) { 
            echo "<tr>"; 
            echo "<td>".$row['r_no']."</td>"; 
            echo "<td>".$row['pres_id']."</td>"; 
            echo "<td>".$row['drug']."</td>"; 
            echo "<td>".$row['quantity']."</td>"; 
            echo "<td>".$row['total']."</td>"; 
            echo "<td>".$row['date']."</td>";
            echo "<td>".$row['doctor_name']."</td>";  
        
            echo "</tr>"; 
        } 
        echo "</table>"; 
        
    } 
    else { 
        echo "No matching records are found."; 
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
    <title>RECEIPTS</title>
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