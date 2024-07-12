<?php
include('../Config/constant.php');
include('partial/menu.php');


// Ensure user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redirect to login page if user is not logged in
    exit;
}

$customer_id = $_SESSION['user'];

// Initialize variables
$ewallet_balance = 0;
$total_amount = 0;
$message = '';

try {
    // Connect to database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch ewallet_balance
    $stmt = $conn->prepare("SELECT ewallet_balance FROM customer WHERE customer_ID = :customer_id");
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->execute();
    $ewallet_balance = (float) $stmt->fetchColumn();

    // Fetch total_amount of the last order (assuming orders are in descending order by ID or date)
    $stmt = $conn->prepare("SELECT balance FROM `order` WHERE customer_ID = :customer_id ORDER BY order_ID DESC LIMIT 1");
    $stmt->bindParam(':customer_id', $customer_id);
    $stmt->execute();
    $total_amount = (float) $stmt->fetchColumn();

    // Handle null values from the database
    if ($ewallet_balance === null) {
        $ewallet_balance = 0.0;
    }
    if ($total_amount === null) {
        $total_amount = 0.0;
    }

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        .header{
            background-color: blue;
            color: whitesmoke;
            text-align: left;
            padding: 20px;
            font-size: 24px;
        }
        .dashboard {
            display: flex;
            justify-content: space-around;
            background-image:url("back.png");
            padding: 20px;
            margin-top: 20px;
        }
        .card {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            width: 30%;
        }
        .card h2 {
            margin: 0;
        }
        .button-container {
            display: flex;
            margin: 20px 0;
            justify-content: flex-end;
            margin-left: auto;
        }
        .button-container button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .make-payment {
            background-color: darkcyan;
            color: white;
            margin-left: 20px;
        }
        .payment-history {
            display: flex;
            justify-content: center;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: bottom 20px;
        }
        .history-btn{
            background-color: darkcyan;
            color: white;
            margin-left: 20px;
            padding: 15px 30px;
            font-size: 18px;
        }

        #ewallet-balance {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        #total-balance {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            background-color: #f5f5f5;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }
    </style>
    
</head>
<body>
    <header class="header">Your E-Wallet</header>
    <div class="dashboard">
        <div class="card">
            <h2>E-WALLET BALANCE</h2>
            <p id="ewallet-balance"><?php echo number_format($ewallet_balance, 2); ?></p>
            <p>Current E-Wallet Balance</p>
        </div>
        <div class="card">
            <h2>PAYMENT BALANCE</h2>
            <p id="total-balance"><?php echo number_format($total_amount, 2); ?></p>
            <p>Your Payment Balance</p>
        </div>
    </div>
    <div class="button-container">
    <a href="Topup.php?customer_ID=<?php echo $customer_id; ?>" class="btn btn-primary">Top Up E-Wallet</a>

    </div>
    <div class="payment-history">
        <button onclick="window.location.href='payment_history.php'" class='history-btn'>Payment History</button>
    </div>
</body>
</html>



<?php include('partial/footer.php'); ?>
