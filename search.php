<?php require 'header.php'?>
<?php require 'footer.php'; ?>
<?php
require 'includes/database.php';
$searchQuery = $_GET['search'];
$conn=getDB();
$sql = "SELECT * FROM products WHERE product_name LIKE '%$searchQuery%' OR product_brand LIKE '%$searchQuery%'";

$result = mysqli_query($conn, $sql);
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