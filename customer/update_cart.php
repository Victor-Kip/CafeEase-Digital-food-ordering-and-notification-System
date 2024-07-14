<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_ID = $_POST['product_ID'];
    $new_quantity = $_POST['quantity'];

    // Update quantity in session cart
    if (isset($_SESSION['cart'][$product_ID])) {
        $_SESSION['cart'][$product_ID]['quantity'] = $new_quantity;
    }
}

// Redirect back to cart page
header('Location: cart.php');
exit();
?>
