<?php
require 'header.php';
require 'includes/database.php';
echo '<h2> My Cart </h2>';

if (isset($_SESSION['cartItems'])) {
    $cartItems = json_decode($_SESSION['cartItems'], true);

    if (!empty($cartItems)) {
        $conn = getDB();
        $ids = implode(",", $cartItems);

        $sql = "SELECT product_id, product_name, product_brand, product_price, product_image FROM products WHERE product_id IN ($ids)";
        $result = mysqli_query($conn, $sql);

        $productQuantities = array_count_values($cartItems);
        $totalPrice = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $productId = $row['product_id'];
            $productQuantity = $productQuantities[$productId];

            echo '<div class="product-card">';
            echo '<div class="product-image">';
            echo '<img src="products/' . $row['product_image'] . '" alt="Product Image">';
            echo '</div>';
            echo '<div class="product-details">';
            echo '<p class="product-name">' . $row['product_name'] . '</p>';
            echo '<p class="product-brand">' . $row['product_brand'] . '</p>';
            echo '<p class="product-price">Rs.' . $row['product_price'] . '</p>';

            echo '<div class="quantity-container">';
            echo '<button class="quantity-btn" onclick="decreaseQuantity(' . $productId . ')">-</button>';
            echo '<span class="quantity">' . $productQuantity . '</span>';
            echo '<button class="quantity-btn" onclick="increaseQuantity(' . $productId . ')">+</button>';
            echo '</div>';

            echo '<button class="remove-from-cart" onclick="removeFromCart(' . $productId . ')">Remove from Cart</button>';

            echo '</div>';
            echo '</div>';

            $productPrice = $row['product_price'];
            $totalPrice += $productPrice * $productQuantity;
        }

        echo '<div class="total-price">Total Price: Rs.' . $totalPrice . '</div>';
        echo '<div class="checkout-container">';
        echo '<a href="checkout.php" class="continue">Checkout</a>';
        echo '</div>';

        mysqli_close($conn);
    } else {
        echo 'Your cart is empty.';
        echo '<br>';
        echo '<a href="home.php" class="continue">Continue Shopping</a>';
    }
} else {
    echo 'Your cart is empty.';

}
?>
    <script>
        
function removeFromCart(productId) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "removeFromCart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload();
        }
    };
    xhr.send("productId=" + productId);
}

function decreaseQuantity(productId) {
    // Send an AJAX request to decrease the product quantity in the cart
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "updateQuantity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Update the cart page to reflect the quantity change
            location.reload();
        }
    };
    xhr.send("productId=" + productId + "&action=decrease");
}

function increaseQuantity(productId) {
    // Send an AJAX request to increase the product quantity in the cart
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "updateQuantity.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Update the cart page to reflect the quantity change
            location.reload();
        }
    };
    
    xhr.send("productId=" + productId + "&action=increase");

}

</script>

    <?php require 'footer.php';?>