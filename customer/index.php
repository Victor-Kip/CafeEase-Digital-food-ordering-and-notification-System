<?php include('partial/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
        <form action="food-search.php" method="POST">
            <input type="search" name="search" placeholder="Enter keywords..." required>
            <button type="submit" name="submit" class="btn btn-primary">Search</button>
        </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
             $sql= "SELECT * FROM category WHERE active='Yes'AND description='Yes' LIMIT 3";

             $res = mysqli_query($conn, $sql);
             if($res==TRUE){
                 $count = mysqli_num_rows($res);
                 if($count>0){
                     while($rows=mysqli_fetch_assoc($res)){
                         $category_ID = $rows['category_ID'];
                         $category_name = $rows['category_name'];
                         $image_name = $rows['image'];
                         ?>
                         <a href="category-foods.php?category_ID=<?php echo $category_ID; ?>">
                           <div class="box-3 float-container">
                            <?php
                            if($image_name==""){

                                echo "<div class='error>Image not available</div>";


                            }
                            else{
                                ?>
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                <?php
                            }
                            ?>

                              

                              <h3 class="float-text text-white"><?php echo $category_name; ?></h3>
                            </div>
                         </a>
                         <?php
                       }
                    }
                    else{

                    }
                }
 
                         ?>
           

            

            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="categories.php">See All Categories</a>
        </p>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            $sql= "SELECT * FROM product WHERE active='Yes'AND featured='Yes'";

            $res = mysqli_query($conn, $sql);
            if($res==TRUE){
                $count = mysqli_num_rows($res);
                if($count>0){
                    while($rows=mysqli_fetch_assoc($res)){
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

        <p class="text-center">
            <a href="foods.php">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include('partial/footer.php') ?>