<?php
include('../Config/constant.php');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
//     $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);

//     if ($amount !== false && $amount > 0) {
        
//         header("Location: eWallet.php?topup_amount=" . urlencode($amount));
//         exit;
//     } else {
//         $error_message = "Please enter a valid amount.";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Up</title>
    <style>
        /* General styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

/* Header styles */
header {
    background-color: blue;
    color: white;
    text-align: center;
    padding: 20px 0;
    font-size: 24px;
}

/* Main content styles */
main {
    padding: 20px;
    max-width: 600px;
    margin: 0 auto;
}

/* Form styles */
form {
    display: flex;
    flex-direction: column;
}

/* Label styles */
label {
    margin-bottom: 10px;
    font-size: 18px;
}

/* Input styles */
input[type="number"] {
    padding: 10px;
    margin-bottom: 20px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Button styles */
button {
    background-color: blue;
    color: white;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

/* Button hover effect */
button:hover {
    background-color: darkblue;
}
    </style>
</head>
<body>
    <header>TopUp The Wallet</header>
    <main>
        <h2>Top Up Your Wallet</h2>
        <form action="" method="POST">
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="ewallet_balance" step="0.01" min="0" required>
            <input type="submit" name="submit" value="Make payment" class="btn-primary">
        </form>
    </main>
</body>
</html>
<?php
// include('Config/constant.php');

if(isset($_POST['submit'])){
    if (!isset($_SESSION['user'])) {
        header('Location: login.php'); // Redirect to login page if user is not logged in
        exit;
    }
    
    $customer_id = $_SESSION['user'];
    $ewallet_balance =$_POST['ewallet_balance'];


// Prepare and execute SQL statement to insert data into patient_table
$sql = "UPDATE customer SET ewallet_balance = '$ewallet_balance' WHERE customer_ID = '$customer_id'";

if ($conn->query($sql) === TRUE) {
   
    header("Location: eWallet.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
// Close the database connection
$conn->close();


?>