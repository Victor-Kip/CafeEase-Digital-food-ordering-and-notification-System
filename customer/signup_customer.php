<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
button[type="submit"] {
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
  <h1>Registration: </h1><br>
    <div>
        <label for="customer_fname"><b>First name: </b></label>
          <input type="text" id="customer_fname" name="customer_fname" required> 
        
    </div><br>
    <div>
        <label for="customer_lname"><b>Last name: </b></label>
          <input type="text" id="customer_lname" name="customer_lname" required> 
        
    </div><br>
    <div>
        <label for="customer_ID"><b>Id number: </b></label>
          <input type="text" id="customer_ID" name="customer_ID" required> 
        
    </div><br>
    <div>
        <label for="EmailAddress"><b>Email: </b></label>
          <input type="email" id="EmailAddress" name="EmailAddress" required> 
        
    </div><br>
    <div>
        <label for="customer_password"><b>Password: </b></label>
          <input type="password" id="customer_password" name="customer_password" required> 
        
    </div><br>
    <div>
        <label for="contactNumber"><b>Phone Number: </b></label>
          <input type="tel" id="contactNumber" name="contactNumber" required> 
        
    </div><br>
    <div>
        <label for="status"><b>Status: </b></label>
          <input type="text" id="status" name="status" required> 
        
    </div><br>
    <input type="submit" name="submit" value="Sign Up" class="btn-primary">
    <a href="login_customer.php" class="btn-primary">login</a>
</form>

</body>
</html>
<?php
include('../Config/constant.php');

if(isset($_POST['submit'])){
$customer_ID =$_POST['customer_ID'];
    $customer_fname =$_POST['customer_fname'];
    $customer_lname =$_POST['customer_lname'];
    $contactNumber =$_POST['contactNumber'];
    $EmailAddress =$_POST['EmailAddress'];
    $status = $_POST['status'];
    $customer_password =md5($_POST['customer_password']);//password encryption with md5

// Prepare and execute SQL statement to insert data into patient_table
$sql = "INSERT INTO customer (customer_ID, customer_fname, customer_lname,  ".
"contactNumber, EmailAddress, status, customer_password) VALUES ('$customer_ID', '$customer_fname', '$customer_lname',".
" '$contactNumber', '$EmailAddress', '$status', '$customer_password')";

if ($conn->query($sql) === TRUE) {
    $_SESSION['add'] = "customer added successfully";
    header("Location: login_customer.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Close the database connection
$conn->close();


?>