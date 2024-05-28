<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin- Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<link rel="stylesheet" href="includes/loginSignup.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .adminProducts{
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }
        .admin-button-container{
            display:flex;
            margin-top: 10px;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
  }
  
  .edit,
  .delete {
    background-color: #50a872;
    color: #ffffff;
    border: none;
    cursor: pointer;
    padding: 10px;
    border-radius: 5px;
    width : 80px;
  }
  .addBtn{
    background-color: #50a872;
    color: #ffffff;
    border: none;
    cursor: pointer;
    padding: 10px;
    border-radius: 5px;
  }
    </style>
</head>
<body>
    <h1>Admin- Home</h1>
    <div class="adminProducts">
        <form action="admin.php">
            <button type="submit" class="addBtn">Add a product</button>
        </form>
        <form action="orders.php">
            <button type="submit" class="addBtn">Review Orders</button>
        </form>
    </div>
    <h2>All Products</h2>
    <?php
    require 'includes/database.php';
    $conn = getDB();
    $sql = "SELECT product_id, product_name, product_brand, product_price, product_image FROM products";

    $stmt=mysqli_prepare($conn, $sql);
  
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $product_id = $row['product_id'];
        echo '<div class="product-card">';
        echo '<div class="product-image">';
        echo '<img src="products/' . $row['product_image'] . '" alt="Product Image">';
        echo '</div>';
        echo '<div class="product-details">';
        echo '<p class="product-name">' . $row['product_name'] . '</p>';
        echo '<p class="product-brand">' . $row['product_brand'] . '</p>';
        echo '<p class="product-price">Rs.' . $row['product_price'] . '</p>';
        echo '<div class="admin-button-container">';
        echo '<form action="adminEdit.php?id=$product_id" method="GET">';
        echo '<input type="hidden" name="id" value="';
        echo $product_id . '">';
        echo '<button type="submit" class="edit">Edit</button>';
        echo '</form>';
        echo '<form action="adminDelete.php?id=$product_id" method="GET">';
        echo '<input type="hidden" name="id" value="';
        echo $product_id . '">';
        echo '<button type="submit" class="delete">Delete</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}
    ?>
</body>
</html>