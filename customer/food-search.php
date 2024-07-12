<?php
include('partial/menu.php');

// Check if form submitted and search term provided
if (isset($_POST['submit']) && isset($_POST['search'])) {
    // Retrieve and sanitize search term
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    // Display the search term
    echo "<section class='food-search text-center'>
              <div class='container'>
                  <h2>Foods on Your Search <span class='text-white'>\"$search\"</span></h2>
              </div>
          </section>";

    // Query to search for products
    $sql = "SELECT * FROM product WHERE active='Yes' AND (product_name LIKE '%$search%' OR description LIKE '%$search%')";
    $res = mysqli_query($conn, $sql);

    if ($res) {
        $count = mysqli_num_rows($res);

        if ($count > 0) {
            echo "<section class='food-menu'>
                      <div class='container'>
                          <h2 class='text-center'>Food Menu</h2>";

            while ($rows = mysqli_fetch_assoc($res)) {
                $product_ID = $rows['product_ID'];
                $product_name = $rows['product_name'];
                $description = $rows['description'];
                $price = $rows['price'];
                $image_name = $rows['image'];

                // Display each product
                echo "<div class='food-menu-box'>
                          <div class='food-menu-img'>";
                if (!empty($image_name)) {
                    echo "<img src='" . SITEURL . "images/food/$image_name' alt='$product_name' class='img-responsive img-curve'>";
                } else {
                    echo "<div class='error'>Image not available</div>";
                }
                echo "</div>
                          <div class='food-menu-desc'>
                              <h4>$product_name</h4>
                              <p class='food-price'>Ksh $price</p>
                              <p class='food-detail'>$description</p>
                              <br>
                              <a href='add_to_cart.php?product_ID=$product_ID&product_name=" . urlencode($product_name) . "&price=$price' class='btn btn-primary'>Add to Cart</a>
                          </div>
                      </div>";
            }

            echo "<div class='clearfix'></div>
                  </div>
              </section>";
        } else {
            // No products found
            echo "<p class='text-center'>No products found.</p>";
        }
    } else {
        // Query execution error
        echo "<p class='text-center'>Error: Unable to execute search query.</p>";
    }
} else {
    // If form not submitted or search term not provided
    echo "<p class='text-center'>Please enter a search term.</p>";
}

include('partial/footer.php');
?>
