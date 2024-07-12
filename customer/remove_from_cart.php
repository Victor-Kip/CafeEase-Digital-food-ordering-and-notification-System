<?php
session_start();

// Check if product_ID is provided
if (isset($_GET['product_ID'])) {
    $product_ID = $_GET['product_ID'];

    // Check if cart array exists in session and if the product_ID exists in cart
    if (isset($_SESSION['cart'][$product_ID])) {
        // Remove the product from the cart
        unset($_SESSION['cart'][$product_ID]);

        // Optionally, you may want to redirect back to the cart page after removal
        header('Location: cart.php');
        exit();
    }
}
// If product_ID is not valid or cart is empty, redirect to cart page
header('Location: cart.php');
exit();
?>
