<?php include('partial/menu.php'); ?>

<?php 

           if(isset($_GET['product_ID'])){
            $product_ID= $_GET['product_ID'];
            $sql= "SELECT * FROM product WHERE product_ID='$product_ID'";

            $res = mysqli_query($conn, $sql);
            if($res==TRUE){
                $rows = mysqli_num_rows($res);
                if($rows==1){
                    $rows=mysqli_fetch_assoc($res);
                        $product_name = $rows['product_name'];
                        $price = $rows['price'];
                        $image_name = $rows['image'];
                        
                    
                }
            }


           }
           else{
            header('location:index.php');
           }
           ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="#" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">                    
                        <img src="../images/menu-pizza.jpg" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                    </div>
                    <div class="food-menu-desc">
                        <h3><?php echo $product_name ?></h3>
                        <p class="food-price">$<?php echo $price ?></p>

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Customer Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>                    

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partial/footer.php') ?>