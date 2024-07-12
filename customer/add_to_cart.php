<?php
session_start();

if (isset($_GET['product_ID'])) {
    $product_ID = $_GET['product_ID'];
    $product_name = $_GET['product_name'];
    $price = $_GET['price'];
    $quantity = 1;

    // Add item to cart session
    $_SESSION['cart'][$product_ID] = array(
        'product_name' => $product_name,
        'price' => $price,
        'quantity' => $quantity
    );

    // Optionally, redirect back to food menu or cart page
    header('Location: foods.php');
    exit;
}
?>
