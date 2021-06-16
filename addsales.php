<?php
  session_start();

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<?php


// initializing variables
$ord_id=0;
$pro_code   = 0;

$units= 0;
$sale_date;
$ord_price  = 0;



// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'inventorymanagement');
if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

// Add item
if (isset($_POST['add'])) {
  // receive all input values from the form
  echo "connect";
  $ord_id=mysqli_real_escape_string($db, $_POST['sale_id']);
  $pro_code=mysqli_real_escape_string($db, $_POST['product_code']);
  $units=mysqli_real_escape_string($db, $_POST['units_sold']);
  $sale_date=mysqli_real_escape_string($db, $_POST['sale_date']);
  $ord_price=mysqli_real_escape_string($db, $_POST['sale_price']);

    $query = "INSERT INTO sales_sb (sale_id,product_code,units_sold,sale_date,sale_price)
  			  VALUES('$ord_id','$pro_code','$units','$sale_date','$ord_price')";

      if(mysqli_query($db, $query))
      {
      echo "<script>alert('Successfully stored');</script>";

    }
    else{
        echo"<script>alert('Somthing wrong!!!');</script>";
    }

  $query2="UPDATE `product` SET `quantity`=`quantity`-$units WHERE `product_id`=$pro_code ";
  echo var_dump($query2);
  $aff=mysqli_affected_rows($db);
  echo "no of aff roes $aff";

   if(mysqli_query($db, $query2))
   {
 echo "<script>alert('Successfully stored');</script>";

  }else{

      echo"<script>alert('Somthing wrong!!!');</script>";

}

  	header('location: table4.php');

}
?>
