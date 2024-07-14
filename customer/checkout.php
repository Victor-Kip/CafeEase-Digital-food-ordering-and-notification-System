<?php
include('partial/menu.php');

if (isset($_POST['submit'])) {
    // Get customer information
    $customer_ID = $_POST['customer_ID'];
    $customer_name = $_POST['customer_name'];
    $customer_phone_number = $_POST['customer_phone_number'];
    $order_date = $_POST['order_date'];
    $total_amount = $_POST['total_amount'];

    // Begin transaction (optional but recommended)
    $conn->begin_transaction();

    try {
        // Loop through each item in the cart and insert into the database
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $item) {
                $product_name = $item['product_name'];
                $price = $item['price'];
                $quantity = $item['quantity'];

                // Prepare SQL statement
                $sql = "INSERT INTO `order` (product_name, price, quantity, customer_ID, customer_name, customer_phone_number, order_date, total_amount) 
                        VALUES ('$product_name', '$price', '$quantity', '$customer_ID', '$customer_name', '$customer_phone_number', '$order_date', '$total_amount')";

                // Execute SQL statement
                if (!$conn->query($sql)) {
                    throw new Exception("Error inserting product '$product_name': " . $conn->error);
                }
            }

            // Commit transaction
            $conn->commit();

            // After all items are inserted, redirect to payment page
            header("Location: eWallet_payment.php");
            exit;
        } else {
            echo "Your cart is empty.";
        }
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo "Transaction failed: " . $e->getMessage();
    }
}

// Close the database connection
$conn->close();
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Checkout</h1>
        <br>
        <br>
        <form action="" method="post">

            <table class="tbl-full">
                <tr>
                    <th>Food Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>

                <?php
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    $total = 0;

                    foreach ($_SESSION['cart'] as $key => $item) {
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;

                        ?>
                        <tr>
                            <td><?php echo $item['product_name']; ?></td>
                            <td><?php echo $item['price']; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo $subtotal; ?></td>
                        </tr>
                        <?php
                    }

                    // Display total cart value at the end
                    ?>
                    <tr>
                        <td colspan="3" align="right"><strong>Total</strong></td>
                        <td><strong><?php echo $total; ?></strong></td>
                    </tr>
                    <?php
                } else {
                    echo '<tr><td colspan="4">Your cart is empty.</td></tr>';
                }
                ?>

                <tr>
                    <td><input type="text" name="customer_ID" placeholder="Enters your Full ID Number"></td>
                    
                </tr>
                <tr>
                    <td><input type="text" name="customer_name" placeholder="Enters your Full Name"></td>
                </tr>
                <tr>
                    <td><input type="tel" name="customer_phone_number" placeholder="Enters your Phone Number"></td>
                </tr>
                <tr>
                    <td><input type="date" name="order_date" p></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="total_amount" value="<?php echo $total; ?>"></td>
                </tr>
                <tr>
                    <td colspan="5" align="right">
                        <input type="submit" name="submit" value="Make Payment" class="btn-primary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php include('partial/footer.php'); ?>
