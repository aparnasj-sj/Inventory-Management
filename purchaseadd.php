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
$purch_id;
$pro_id  ;
$noRec= 0;
$P_date;


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
  $purch_id=mysqli_real_escape_string($db, $_POST['purchase_id']);
  $pro_id=mysqli_real_escape_string($db, $_POST['product_id']);
  $noRec=mysqli_real_escape_string($db, $_POST['Number_received']);
  $P_date=mysqli_real_escape_string($db, $_POST['purchase_date']);

    $query = "INSERT INTO purchase (purchase_id,product_id,Number_received,purchase_date)
  			  VALUES('$purch_id','$pro_id','$noRec','$P_date')";

      if(mysqli_query($db, $query))
      {
      echo "<script>alert('Successfully stored');</script>";

    }
    else{
        echo"<script>alert('Somthing wrong!!!');</script>";
    }
    $query2="UPDATE `product` SET `quantity`=`quantity`+$noRec WHERE `product_id`=$pro_id ";
    echo var_dump($query2);
    $aff=mysqli_affected_rows($db);
    echo "no of aff roes $aff";

     if(mysqli_query($db, $query2))
     {
   echo "<script>alert('Successfully stored');</script>";

    }else{
      echo"<script>alert('Somthing wrong!!!');</script>";
  }
  #  $query2="UPDATE quantity SET quantity=quantity+$noRec WHERE product_name=purchase.product_id";

  #  if(mysqli_query($db, $query2))
  #  {
  #  echo "<script>alert('Successfully stored');</script>";

  #}
#  else{
#      echo"<script>alert('Somthing wrong!!!');</script>";
#  }

  	header('location: table2.php');

}
?>
