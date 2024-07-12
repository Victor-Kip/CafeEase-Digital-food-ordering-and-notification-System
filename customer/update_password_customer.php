<?php include('partial/menu.php'); ?>
<div class="main-content">
        <div class="wrapper">
            <h1>Change password</h1>
            <br><br>
            <?php

            if(isset($_GET['customer_ID'])){
                $customer_ID= $_GET['customer_ID'];
            }
            ?>


            <form action="" method="POST">
                <table class="tbl-30">
                <tr>
                    <td>Curent Password:</td>
                    <td><input type="password" name="current_password" placeholder="current password"></td>
                    
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="new password"></td>
                    
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="confirm password"></td>
                    
                </tr>
                <tr>
                    <td colspan="2">
                    <input type="hidden" name="customer_ID" value="<?php echo $customer_ID; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-primary">

                    </td>
                    
                </tr>

                </table>


            </form>

            


        </div>
</div>

<?php
if(isset($_POST['customer_ID'])){
    $customer_ID =$_POST['customer_ID'];
    $current_password =md5($_POST['current_password']);//password encryption with md5
    $new_password =md5($_POST['new_password']);//password encryption with md5
    $confirm_password =md5($_POST['confirm_password']);//password encryption with md5

    $sql = "SELECT * FROM customer WHERE customer_ID= '$customer_ID' AND customer_password= '$current_password' ";
    $res= mysqli_query($conn, $sql);
    if($res==true){
        $count= mysqli_num_rows($res);
        if($count==1){
            
            if($new_password == $confirm_password){

                $sql2 = "UPDATE customer SET
                customer_password= '$new_password'
                WHERE customer_ID= '$customer_ID'";
                $res2= mysqli_query($conn, $sql2);
                if($res2==true){

                    $_SESSION['change-password'] = "Password changed Successfully";
                    header('location:customer.php');

                }else{
                    $_SESSION['change-password'] = "Password not Successfully";
                    header('location:customer.php');

                }

            }
            else{
                $_SESSION['password-not-match'] = "password do not match";
            header('location:customer.php');
            }

         }
         else{
            $_SESSION['user-not-found'] = "User not found";
            header('location:customer.php');
        }
    }
}
?>

<?php include('partial/footer.php'); ?>