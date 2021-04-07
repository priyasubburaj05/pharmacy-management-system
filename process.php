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
$sql = "SELECT prescription_detail.pres_id,prescription_detail.cust_name,prescription_detail.drug_name,prescription_detail.quantity,prescription_detail.doctor_name,prescription.date FROM prescription_detail  INNER JOIN  prescription ON prescription_detail.pres_id=prescription.pres_id WHERE prescription_detail.cust_name='$_SESSION[cust_name]'";
if ($res = mysqli_query($link, $sql)) { 
    if (mysqli_num_rows($res) > 0) { 
        echo "<table>"; 
        echo "<tr>"; 
        echo "<th>PRESCRIPTION-ID</th>"; 
        echo "<th>NAME</th>"; 
        echo "<th>DRUG</th>";
        echo "<th>QUANTITY</th>"; 
        echo "<th>DOCTOR-NAME</th>"; 
        echo "<th>DATE</th>"; 
        echo "</tr>"; 
        while ($row = mysqli_fetch_array($res)) { 
            echo "<tr>"; 
            echo "<td>".$row['pres_id']."</td>"; 
            echo "<td>".$row['cust_name']."</td>"; 
            echo "<td>".$row['drug_name']."</td>";
            echo "<td>".$row['quantity']."</td>"; 
            echo "<td>".$row['doctor_name']."</td>"; 
            echo "<td>".$row['date']."</td>";  
            echo " TOTAL =  2500";
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
echo " ORDER SUCCESSFULL";
mysqli_close($link); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RECEIPT</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
<h1>RECEIPT</h1>
<p>
   <a href="logout.php" class="btn btn-danger">LOGOUT</a>
    </p>
</body>
</html>




