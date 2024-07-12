<?php
session_start();

if (!isset($_SESSION['ewallet_balance'])) {
    $_SESSION['ewallet_balance'] = 0; // Initialize the wallet balance if not set
}

$ewallet_balance = $_SESSION['ewallet_balance'];

if (isset($_GET['payment_amount'])) {
    $payment_amount = filter_input(INPUT_GET, 'payment_amount', FILTER_VALIDATE_FLOAT);

    if ($payment_amount !== false && $payment_amount > 0) {
        if ($payment_amount <= $ewallet_balance) {
            // Subtract the payment amount from the user's wallet
            $ewallet_balance -= $payment_amount;
            $total_balance = 0; // Reset the total payment balance

            // Update the session with the new balance
            $_SESSION['ewallet_balance'] = $ewallet_balance;

            // Redirect back to the dashboard with the updated balance
            header("Location: ewallet.php?ewallet_balance=$ewallet_balance&total_balance=$total_balance");
            exit;
        } else {
            // Handle insufficient funds
            echo "Insufficient funds in your E-Wallet.";
        }
    } else {
        // Handle invalid payment amount
        echo "Invalid payment amount.";
    }
} 

?>