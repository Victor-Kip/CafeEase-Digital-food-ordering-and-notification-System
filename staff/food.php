<?php include('partials/menu.php'); ?>
<!--Main content section starts -->
    <div class="main-content">
        <div class="wrapper">
           <h1>Manage Food</h1>
           <br>
           <br>

           <?php 
           if(isset($_SESSION['add'])){
            echo $_SESSION['add'];//display session message
            unset($_SESSION['add']);//remove session message
           }
           if(isset($_SESSION['update'])){
            echo $_SESSION['update'];//display session message
            unset($_SESSION['update']);//remove session message
           }
           if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];//display session message
            unset($_SESSION['upload']);//remove session message
           }
           if(isset($_SESSION['failed to remove'])){
            echo $_SESSION['failed to remove'];//display session message
            unset($_SESSION['failed to remove']);//remove session message
           }
           ?>
           <br><br>

           <!-- Button to add Admin -->
            <a href="add_food.php" class="btn-primary">Add Food</a>
           <br>
           <br>
           <br>

           <table class="tbl-full">
            <tr>
                <th>Food ID</th>
                <th>Food Name</th>
                <th>Image</th>
                <th>Description</th>
                <th>Price</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>
            <?php 
            $sql= "SELECT * FROM product";

            $res = mysqli_query($conn, $sql);
            if($res==TRUE){
                $rows = mysqli_num_rows($res);
                if($rows>0){
                    while($rows=mysqli_fetch_assoc($res)){
                        $product_ID = $rows['product_ID'];
                        $product_name = $rows['product_name'];
                        $description = $rows['description'];
                        $price = $rows['price'];
                        $image_name = $rows['image'];
                        $featured = $rows['featured'];
                        $active = $rows['active'];

                        ?>

            <tr>
                <td><?php echo $product_ID; ?></td>
                <td><?php echo $product_name; ?></td>
                <td>
                    <?php
                    if($image_name!=""){
                        ?>
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">

                        <?php

                    }
                    else{
                        echo "<div class='error'>image not available</div>";
                    }
                     
                     ?>
                </td>
                <td><?php echo $description; ?></td>
                <td><?php echo $price; ?></td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                <a href="<?php echo SITEURL ?>admin/update_food.php?product_ID= <?php echo $product_ID; ?>" class="btn-secondary">Update</a>
                            <a href="<?php echo SITEURL ?>admin/delete_food.php?product_ID= <?php echo $product_ID; ?>" class="btn-danger">Delete</a>
                </td>
            </tr>
            <?php
                    }

                }
                else{

                }

            }
            
            ?>
            
           </table>
        </div>
        

    </div>
    <!-- main content end -->
    <?php include('partials/footer.php'); ?>