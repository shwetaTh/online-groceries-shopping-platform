<?php require 'header.php'?>
<?php
require 'includes/database.php';
if (isset($_GET['category'])) {
    $selectedCategory = $_GET['category'];
    if ($selectedCategory=='pantry') {
        $display='Pantry';
      }
      if ($selectedCategory=='produce') {
        $display='Produce';
      }
      if ($selectedCategory=='bakery') {
        $display='Bakery';
      }
      if ($selectedCategory=='snacks') {
        $display='Snacks';
      }
      if ($selectedCategory=='dairyAndEggs') {
        $display='Dairy & Eggs';
      }
      if ($selectedCategory=='meatAndSeafood') {
        $display='Meat & Seafood';
      }
      if ($selectedCategory=='beverages') {
        $display='Beverages';
      }
      if ($selectedCategory=='frozenSection') {
        $display='Frozen Section';
      }
      if ($selectedCategory=='toiletries') {
        $display='Toiletries';
      }

      echo "<h2>Category: $display</h2>";
    } else {
      echo "<h1>No category selected.</h1>";
    }
  $conn=getDB();
  $sql = "SELECT product_id, product_name, product_brand, product_price, product_image FROM products WHERE product_category = ?";

  $stmt=mysqli_prepare($conn, $sql);
  $stmt->bind_param("s", $selectedCategory);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '<div class="product-card">';
      echo '<div class="product-image">';
      echo '<img src="products/' . $row['product_image'] . '" alt="Product Image">';
      echo '</div>';
      echo '<div class="product-details">';
      echo '<p class="product-name">' . $row['product_name'] . '</p>';
      echo '<p class="product-brand">' . $row['product_brand'] . '</p>';
      echo '<p class="product-price">Rs.' . $row['product_price'] . '</p>';
      echo '<div class="button-container">';
      echo '<form onsubmit="return addToCart(' . $row['product_id'] . ')">';
      echo '<button type="submit" class="add-to-cart">Add to Cart</button>';
      echo '</form>';
      echo '<form onsubmit="return addToCart(' . $row['product_id'] . ')">';
      echo '<button type="submit" class="buy-now">Buy Now</button>';
      echo '</form>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
  }
}else {
    echo 'Sorry! No products found for the selected category';
  }

?>

    <script>
    function addToCart(productId) {
        var xhr = new XMLHttpRequest();

        xhr.open("POST", "addToCart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
            }
        };
        xhr.send("productId=" + productId);
        showPopup();
        return false;
    }
    </script>
<?php require 'footer.php'; ?>