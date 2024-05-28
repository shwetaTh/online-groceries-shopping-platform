<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
<link rel="stylesheet" href="includes/loginSignup.css">
<style>
    .flexAdmin{
        display: flex;
    }
    .formadd{
        display: flex;
  justify-content: center;
  align-items: center;
  flex: 1;
  padding: 20px;
  width: 100%;
  height: 40rem;
  background-color: #f5f5f5;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
    }
    .adminbtn{
    background-color: #50a872;
    color: #ffffff;
    border: none;
    cursor: pointer;
    padding: 10px;
    border-radius: 5px;
    }
    .adminbtnflex{
        display: flex;
        justify-content: space-between;
    }
    input[type="text"] {
  font-size: 16px;
  width: 400px;
  height: 30px;
}
</style>
</head>

<?php
require 'includes/database.php';
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $conn = getDB();
    $sql = 'SELECT * FROM products WHERE product_id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $product_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $product = mysqli_fetch_assoc($result);
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $pname = $_POST['product_name'];
    $pcat = $_POST['product_category'];
    $pbrand = $_POST['product_brand'];
    $pprice = $_POST['product_price'];
    $pdesc = $_POST['product_description'];

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        $pimg = $_FILES['product_image']['name'];
        $targetDir = 'products/';
        $targetFile = $targetDir . basename($pimg);
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile)) {
        } else {
            echo 'Failed to upload the image.';
            exit;
        }
    } else {
        if (isset($product['product_image']) && !empty($product['product_image'])) {
            $pimg = $product['product_image'];
        } else {
            $pimg = ''; 
        }
    }

    if ($product_id == '' || $pname == '' || $pcat == '' || $pbrand == '' || $pprice == '' || $pdesc == '') {
        echo 'One or more fields are empty';
    } else{
        $conn = getDB();
        $sql = 'UPDATE products SET product_name = ?, product_category = ?, product_brand = ?, product_price = ?, product_description = ?, product_image = ? WHERE product_id = ?';
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, 'ssssssi', $pname, $pcat, $pbrand, $pprice, $pdesc, $pimg, $product_id);
            mysqli_stmt_execute($stmt);
        }
        header('Location: adminHome.php');
        exit;    
    }
}

    

?>
<div class="flexAdmin">

<div class= "formadd">

<form action="" method="post" enctype="multipart/form-data">
<h2>Edit Product</h2>
    <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?? ''; ?>">
  
    <label for="product_name">Product Name:</label> <br>
    <input type="text" name="product_name" value="<?php echo $product['product_name'] ?? ''; ?>"><br>
    <label for="product_category">Product Category:</label> <br>
    <input type="text" name="product_category" value="<?php echo $product['product_category'] ?? ''; ?>"><br>
    <label for="product_brand">Product Brand:</label> <br>
    
    <input type="text" name="product_brand" value="<?php echo $product['product_brand'] ?? ''; ?>"><br>
    <label for="product_price">Product Price:</label> <br>
    <input type="text" name="product_price" value="<?php echo $product['product_price'] ?? ''; ?>"><br>
    <label for="product_description">Product Description:</label> <br>
    <input type="text" name="product_description" value="<?php echo $product['product_description'] ?? ''; ?>"><br>
    <label for="current_image">Current Image:</label> <br>
    <?php if (isset($product['product_image']) && !empty($product['product_image'])) : ?>
        <img src="products/<?php echo $product['product_image']; ?>" alt="Current Image" style="max-width: 200px;"><br>
    <?php else : ?>
        <span>No Image Found</span><br>
    <?php endif; ?>
    <label for="new_image">Upload New Image:</label>
    <input type="file" name="product_image"><br>
    <div class="adminbtnflex">
    <button type="submit">Update Product</button>
    <a href="adminHome.php">Cancel</a>
    </div>
    
</form>
    </div>
    </div>
