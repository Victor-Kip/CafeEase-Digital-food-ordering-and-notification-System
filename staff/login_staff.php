<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
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
<form action=" " method="post">
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
        <label for="staff_ID"><b>Id number: </b></label>
          <input type="text" id="staff_ID" name="staff_ID" required> 
        
    </div><br>
    
    <div>
        <label for="staff_password"><b>Password: </b></label>
          <input type="password" id="staff_password" name="staff_password" required> 
    </div> <br>
    <input type="submit" name="submit" value="login" class="btn-primary">
    <a href="signup_staff.php" class="btn-primary">SignUp</a>
</form>
    
</body>
</html>

<?php
// Start session (if not already started)


// Include necessary files and configuration
include('../Config/constant.php');

if(isset($_POST['submit'])) {
    $staff_ID = $_POST['staff_ID'];
    $staff_password = md5($_POST['staff_password']);

    $sql ="SELECT * FROM staff WHERE staff_ID='$staff_ID' AND staff_password='$staff_password'";
    $res = mysqli_query($conn, $sql);

    if($res) {
        $count = mysqli_num_rows($res);

        if($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $_SESSION['user'] = $row['staff_ID']; // Set session variable with staff_ID
            header('location: profile.php'); // Redirect to profile page
            exit;
        } else {
            $_SESSION['login'] = "<div class='error'>Login unsuccessful. Please check your credentials.</div>";
            header('location: login_staff.php');
            exit;
        }
    } else {
        echo "Query error: " . mysqli_error($conn);
    }
}
?>
