<?php 


include('partial/menu.php');
include('../Config/constant.php');

// Check if customer_ID is set in URL query
if(isset($_GET['customer_ID'])) {
    $customer_ID = $_GET['customer_ID'];

    // Fetch user data from database
    $sql = "SELECT * FROM customer WHERE customer_ID = '$customer_ID'";
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $customer_fname = $row['customer_fname'];
        $customer_lname = $row['customer_lname'];
        $contactNumber = $row['contactNumber'];
        $EmailAddress = $row['EmailAddress'];
        $status = $row['status'];
    } else {
        // Redirect or handle if no user found
        header('location: profile.php');
        exit();
    }
} else {
    // Redirect if customer_ID is not provided
    header('location: profile.php');
    exit();
}
?>

<div class="main-content">
    <div class="wrapper">
        <h1>My Account</h1>
        <br>
        <br>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>First Name:</td>
                    <td><h4><?php echo $customer_fname; ?></h4></td>
                    
                </tr>
                <tr>
                    <td>Last Name:</td>
                    <td><h4><?php echo $customer_lname; ?></h4></td>
                    
                </tr>
                <tr>
                    <td>Phone Number:</td>
                    <td><h4><?php echo $contactNumber; ?></h4></td>
                    
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><h4><?php echo $EmailAddress; ?></h4></td>
                    
                </tr>
                <tr>
                    <td>Status:</td>
                    <td><h4><?php echo $status; ?></h4></td>
                    
                </tr>
                
                <tr>
                    <td colspan="2">
                        
                        <a href="<?php echo SITEURL ?>customer/update_password_customer.php?customer_ID= <?php echo $customer_ID; ?>" class="btn-primary">Change password</a>
                            <a href="<?php echo SITEURL ?>customer/update_customer.php?customer_ID= <?php echo $customer_ID; ?>" class="btn-secondary">Update</a>
                    </td>
                    
                </tr>
            </table>
        </form>

    </div>
</div>



<?php include('partial/footer.php'); ?>
