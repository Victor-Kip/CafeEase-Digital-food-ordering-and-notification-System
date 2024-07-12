<?php include('partial/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update customer</h1>
        <br>
        <br>

        <?php 
        //get the Id of the selected customer
        $customer_ID= $_GET['customer_ID'];
        
        //sql query
        $sql="SELECT * FROM customer WHERE customer_ID = $customer_ID";

        $res=mysqli_query($conn, $sql);
        if($res==true){
            $count = mysqli_num_rows($res);

            if($count==1){

                $row= mysqli_fetch_assoc($res);
                $customer_ID = $row['customer_ID'];
                $customer_fname = $row['customer_fname'];
                $customer_lname = $row['customer_lname'];
                $contactNumber = $row['contactNumber'];
                $EmailAddress = $row['EmailAddress'];
                $status = $row['status'];

            }
            // else{
            //     header('location:customer.php');
            // }

        }
        

        
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>First Name:</td>
                    <td><input type="text" name="customer_fname" value="<?php echo $customer_fname; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><input type="text" name="customer_lname" value="<?php echo $customer_lname; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><input type="tel" name="contactNumber" value="<?php echo $contactNumber; ?>"</td>
                    
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input type="text" name="EmailAddress" value="<?php echo $EmailAddress; ?>"></td>
                    
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><input type="text" name="status" value="<?php echo $status; ?>"></td>
                    
                </tr>
                
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="customer_ID" value="<?php echo $customer_ID; ?>">
                        <input type="submit" name="submit" value="Update customer" class="btn-primary">

                    </td>
                    
                </tr>
            </table>
        </form>

    </div>
</div>

<?php 
//check submit button if clicked or not
if(isset($_POST['submit'])){
    //get values from form
    $customer_ID = $_POST['customer_ID'];
    $customer_fname = $_POST['customer_fname'];
    $customer_lname = $_POST['customer_lname'];
    $contactNumber = $_POST['contactNumber'];
    $EmailAddress = $_POST['EmailAddress'];
    $status= $_POST['status'];

    //sql query
    $sql = "UPDATE customer SET
    customer_fname = '$customer_fname',
    customer_lname = '$customer_lname',
    contactNumber = '$contactNumber',
    EmailAddress = '$EmailAddress',
    status = '$status'
     WHERE customer_ID= '$customer_ID'
     ";

     //execute the query
     $res= mysqli_query($conn, $sql);

     //check if query is successfull
     if($res==TRUE){

        $_SESSION['update']= "<div class='success'>customer updated successfully</div>";
        header("Location: customer.php");
        exit();
        
    }
    else{
        $_SESSION['update']="<div class='error'>Update failed. Try again</div>";
        header("Location: customer.php");
        exit();
    }
}

?>

<?php include('partial/footer.php'); ?>