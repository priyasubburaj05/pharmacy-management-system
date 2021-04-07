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
$stock_id="";
$drug_name="";
$date_supplied="";
$description="";
$supplier="";
$quantity="";
$cost="";
$availability="";
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>insertion/deletion of stock</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div id="main-wrapper">
        <center><h2>INSERT/UPDATE/DELETE STOCK!</h2></center>
<div class="inner_container">
    <?php
        if(isset($_POST['fetch_btn'])){
            $stock_id = $_POST['stock_id'];
            if($stock_id=="")
            {
                echo '<script type="text/javascript">alert("enetr stockid to get drug details")</script>';
            }
            {
                $query="select * from stock where stock_id=$stock_id";
                $query_run=mysqli_query($link,$query);
                if($query_run)
                {
                    if(mysqli_num_rows($query_run)>0)
                    {
                        $row= mysqli_fetch_array($query_run,MYSQLI_ASSOC);
                        $stock_id=$row['stock_id'];
                        $drug_name=$row['drug_name'];
                        $date_supplied=$row['date_supplied'];
                        $description=$row['description'];
                        $supplier=$row['supplier'];
                        $quantity=$row['quantity'];
                        $cost=$row['cost'];
                        $availability=$row['availability'];
                
                    }
                    else{
                        echo '<script type="text/javascript">alert("invalid stock id")</script>';
                    }
                }
                else{
                    echo '<script type="text/javascript">alert("error in query")</script>';
                }
                
            }
            
        }
        
    ?>    
            <form action="update.php" method="post">
                <label><b>Stock ID</b> </label><button id="btn_go" name="fetch_btn" type="submit">GO</button>
                <input type="text" placeholder="enter the stock id" name="stock_id" value="<?php echo $stock_id; ?>">
                <label><b>Drug Name</b></label>
                <input type="text" placeholder="enter the drug name" name="drug_name" value="<?php echo $drug_name; ?>">
                <label><b>Date Supplied</b></label>
                <input type="date" placeholder="enter date supplied" name="date_supplied" value="<?php echo $date_supplied; ?>">
                <label><b>Description</b></label>
                <input type="text" placeholder="enter the Description" name="description" value="<?php echo $description; ?>">
                <label><b>Supplier</b></label>
                <input type="text" placeholder="enter the supplier" name="supplier" value="<?php echo $supplier; ?>">
                <label><b>Quantity</b></label>
                <input type="number" placeholder="enter the quantity" name="quantity" value="<?php echo $quantity; ?>">
                <label><b>Cost</b></label>
                <input type="number" placeholder="enter the cost" name="cost" value="<?php echo $cost; ?>">
                <label><b>Availability</b></label>
                <input type="text" placeholder="enter availability" name="availability" value="<?php echo $availability; ?>">
                <center>
                    <button id="btn_insert" name="insert_btn" type="submit">Insert</button>
                    <button id="btn_update" name="update_btn" type="submit">Update</button>
                    <button id="btn_delete" name="delete_btn" type="submit">Delete</button>
<p>
   <a href="stock.php" class="btn btn-danger">GO BACK</a>
</p>
                    
                </center>
            </form>
            <?php
            if(isset($_POST['insert_btn'])){
                $stock_id=$_POST['stock_id'];
                $drug_name=$_POST['drug_name'];
                $date_supplied=$_POST['date_supplied'];
                $description=$_POST['description'];
                $supplier=$_POST['supplier'];
                $quantity=$_POST['quantity'];
                $cost=$_POST['cost'];
                $availability=$_POST['availability'];
                
                if($stock_id=="" || $drug_name=="" || $date_supplied=="" || $description=="" || $supplier=="" || $quantity=="" || $cost==""|| $availability=="")
                {
                    echo '<script type="text/javascript">alert("insert values in all fields")</script>';
                }
                else{
                    $query = "insert into stock values($stock_id,'$drug_name','$date_supplied','$description', '$supplier',$quantity,$cost,'$availability')";
                    $query_run=mysqli_query($link,$query);
                    if($query_run)
                    {
                        echo '<script type="text/javascript">alert("values intered successfully:)")</script>';
                    }
                    else{
                        echo '<script type="text/javascript">alert("values intered successfully:)")</script>';
                        
                    }
                    
            
                }
            }
            else if(isset($_POST['update_btn']))
            {
                if($_POST['stock_id']=="" || $_POST['drug_name']=="" || $_POST['date_supplied']=="" || $_POST['description']=="" || $_POST['supplier']=="" || $_POST['quantity']=="" || $_POST['cost']=="" || $_POST['availability']=="")
                {
                    echo '<script type="text/javascript">alert("insert values in all fields")</script>';
                }
                else{
                    $stock_id=$_POST['stock_id'];
                    $drug_name=$_POST['drug_name'];
                    $date_supplied=$_POST['date_supplied'];
                    $description=$_POST['description'];
                    $supplier=$_POST['supplier'];
                    $quantity=$_POST['quantity'];
                    $cost=$_POST['cost'];
                    $availability=$_POST['availability'];
                    
                    $query = "update stock
                        SET stock_id='$stock_id', drug_name='$drug_name', date_supplied='$date_supplied', description='$description', supplier='$supplier', quantity='$quantity', cost='$cost', availability='$availability'
                        WHERE stock_id=$stock_id";
                        
                        $query_run = mysqli_query($link,$query);
                        
                            if($query_run)
                            {
                                echo '<script type="text/javascript">alert("stock updated successfully:)")</script>';
                            }
                            else{
                                echo '<script type="text/javascript">alert("error")</script>';
                            }
                        
                    
                }
            }
            else if(isset($_POST['delete_btn']))
            {
                if($_POST['stock_id']=="")
                {
                    echo '<script type="text/javascript">alert("enter stock id to delete")</script>';
                }
            else{
                    $stock_id = $_POST['stock_id'];
                    
                    $query = "delete from stock
                        WHERE stock_id=$stock_id";
                        $query_run = mysqli_query($link,$query);
                        if($query_run)
                            {
                                echo '<script type="text/javascript">alert("product deleted:)")</script>';
                            }
                            else{
                                echo '<script type="text/javascript">alert("error")</script>';
                            }
                    
                }
            }
            

        ?>    

        </div>
    </div>

</body>
</html>