<?php 

include('../Config/constant.php');

//1.get id of product to be deleted
echo $order_id= $_GET['order_id'];

//2.create sql query to delete product
$sql= "DELETE FROM `order` WHERE order_id='$order_id'";

//execute the query
$res= mysqli_query($conn,$sql);
//check whether the query executed successfully or not
if($res==TRUE){

    $_SESSION['delete']= "<div class='success'>product deleted successfully</div>";
    header("Location: order.php");
    exit();
    
}
else{
    $_SESSION['delete']="<div class='error'>Deletion failed. Try again</div>";
    header("Location: order.php");
    exit();
}

//3. Redirect to product page

?>