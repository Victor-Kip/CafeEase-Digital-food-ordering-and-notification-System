<?php include('partial/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
             $sql= "SELECT * FROM category WHERE active='Yes'";

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
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partial/footer.php') ?>