<?php
include('partial/menu.php');
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Cart</h1>
        <br>
        <br>

        <table class="tbl-full">
            <tr>
                <th>Food Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>

            <?php
            $total = 0;

            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $product_ID => $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                    ?>

                    <tr>
                        <td><?php echo $item['product_name']; ?></td>
                        <td><?php echo $item['price']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo $subtotal; ?></td>
                        <td>
                            <a href="remove_from_cart.php?product_ID=<?php echo $product_ID; ?>" class="btn btn-danger">Remove</a>
                        </td>
                    </tr>

                    <?php
                }
            } else {
                echo '<tr><td colspan="5">Your cart is empty.</td></tr>';
            }
            ?>

            <tr>
                <td colspan="3" align="right"><strong>Total</strong></td>
                <td colspan="2"><strong><?php echo $total; ?></strong></td>
            </tr>
            <tr>
                <td colspan="5" align="right">
                    <a href="checkout.php" class="btn btn-primary">Checkout</a>
                </td>
            </tr>
        </table>
    </div>
</div>

<?php include('partial/footer.php'); ?>
