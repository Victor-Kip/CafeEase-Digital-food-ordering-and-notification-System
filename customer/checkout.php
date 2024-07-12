<?php


include('partial/menu.php');

?>
<?php
// include('Config/constant.php');

if(isset($_POST['submit'])){
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $customer_ID = $_POST['customer_ID'];
    $customer_name = $_POST['customer_name'];
    $customer_phone_number = $_POST['customer_phone_number'];
    $order_date = $_POST['order_date'];
    $total_amount = $_POST['total_amount'];
    

// Prepare and execute SQL statement to insert data into patient_table
$sql = "INSERT INTO `order` (product_name, price, quantity, customer_ID, customer_name, customer_phone_number, order_date, total_amount) VALUES ('$product_name', '$price', '$quantity', '$customer_ID', '$customer_name', '$customer_phone_number', '$order_date', '$total_amount')";


if ($conn->query($sql) === TRUE) {
    header("Location: eWallet_payment.php");
        exit;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
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
                    
                    <td><input type="hidden" name="product_name" value="<?php echo $item['product_name']; ?>"></td>
                    
                    
            </tr>
            <tr>
                   
                    <td><input type="hidden" name="price" value="<?php echo $item['price']; ?>"></td>
                    
                    
            </tr>
            <tr>
                    
                    <td><input type="hidden" name="quantity" value="<?php echo $item['quantity']; ?>"></td>
                    
                    
            </tr>
            <tr>
                    <td>ID:</td>
                    <td><input type="text" name="customer_ID" placeholder="Enters your Full ID Number"></td>
                    
                    
            </tr>
            <tr>
                    <td>Name:</td>
                    <td><input type="text" name="customer_name" placeholder="Enters your Full Name"></td>
                    
            </tr>
            <tr>
                    <td>Phone Number:</td>
                    <td><input type="tel" name="customer_phone_number" placeholder="Enters your Phone Number"></td>
                    
            </tr>
            <tr>
                    <td>Date:</td>
                    <td><input type="date" name="order_date"></td>
                    
            </tr>
            <tr>
                    <td><input type="hidden" name="total_amount" value="<?php echo $total; ?>"></td>
                    
                    
            </tr>
            <tr>
                        <td colspan="5" align="right">
                            <input type="submit" name="submit" value="Make payment" class="btn-primary">
                        </td>
                    </tr>

        </table>
        </form>
    </div>
</div>

<?php include('partial/footer.php'); ?>
