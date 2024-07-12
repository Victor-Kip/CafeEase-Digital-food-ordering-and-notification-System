<?php include('partial/menu.php'); ?>

<?php 
if(isset($_GET['category_ID'])){

    $category_ID = $_GET['category_ID'];
    $sql= "SELECT category_name FROM category WHERE category_ID= '$category_ID'";

    $res= mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    $category_name= $row['category_name'];

}
else{
    header('location: index.php');
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_name; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            $sql2 = "SELECT * FROM product WHERE category_ID='$category_ID'";
            $res2 = mysqli_query($conn, $sql2);
            if($res2==TRUE){
                $count = mysqli_num_rows($res2);
                if($count>0){
                    while($rows=mysqli_fetch_assoc($res2)){
                        $product_ID = $rows['product_ID'];
                        $product_name = $rows['product_name'];
                        $description = $rows['description'];
                        $price = $rows['price'];
                        $image_name = $rows['image'];

                        ?>
                        <div class="food-menu-box">
                          <div class="food-menu-img">

                          
                            <?php
                            if($image_name==""){

                                echo "<div class='error>Image not available</div>";


                            }
                            else{
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            ?>
                            
                          </div>

                          <div class="food-menu-desc">
                            <h4><?php echo $product_name; ?></h4>
                            <p class="food-price">Ksh<?php echo $price; ?></p>
                            <p class="food-detail">
                            <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="add_to_cart.php?product_ID=<?php echo $product_ID; ?>&product_name=<?php echo urlencode($product_name); ?>&price=<?php echo $price; ?>" class="btn btn-primary">Add to Cart</a>
                         </div>
                        </div>
                        <?php
                    }
                }
            }
            ?>
             

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partial/footer.php') ?>