
<?php include('../Config/constant.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="../css/admin.css">
<style>
  /* styles.css */

/* Apply styles to the entire page */
body {
    background-color: white;
    font-family: Arial, sans-serif;
}

/* Style the form container */
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
}

/* Style form labels */
label {
    font-weight: bold;
}

/* Style input fields */
input[type="text"],
input[type="number"],
input[type="email"],
input[type="password"],
input[type="tel"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

/* Style the submit button */
input[type="submit"] {
    background-color: #0074d9;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 3px;
    cursor: pointer;
}

/* Style the login link */
a {
    color: #0074d9;
    text-decoration: none;
}
  
</style>
</head>
<body>
<form action="" method="post">
  <h1>Login: </h1><br>
  <?php
  if(isset($_SESSION['login'])){
    echo $_SESSION['login'];//display session message
    unset($_SESSION['login']);//remove session message
   }
   if(isset($_SESSION['no-login'])){
    echo $_SESSION['no-login'];//display session message
    unset($_SESSION['no-login']);//remove session message
   }
   ?><br>

    <div>
        <label for="customer_ID"><b>Id number: </b></label>
          <input type="text" id="customer_ID" name="customer_ID" required> 
        
    </div><br>
    
    <div>
        <label for="customer_password"><b>Password: </b></label>
          <input type="password" id="customer_password" name="customer_password" required> 
    </div> <br>
    <input type="submit" name="submit" value="login" class="btn-primary">
    <a href="signup_customer.php" class="btn-primary">SignUp</a>
</form>

    
</body>
</html>

<?php 


if(isset($_POST['submit'])){
    $customer_ID = $_POST['customer_ID'];
    $customer_password = md5($_POST['customer_password']);

    $sql ="SELECT * FROM customer WHERE customer_ID='$customer_ID' AND customer_password='$customer_password'";
    $res= mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($res) == 1){
        $_SESSION['login'] = "<div class='success'>Login successful</div>";
        $_SESSION['user'] = $customer_ID;
        header('location: profile.php?customer_ID='.$customer_ID); // Redirect to profile page with customer_ID
        exit();
    }
    else {
        $_SESSION['login'] = "<div class='error'>Login unsuccessful</div>";
        header('location: login_customer.php');
        exit();
    }
}
?>

