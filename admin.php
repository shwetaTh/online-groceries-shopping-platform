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
  height: 25rem;
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
<body>

<?php
require 'includes/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            // File upload successful
        } else {
            echo 'Failed to upload the image.';
            exit;
        }
    } else {
        echo 'Error uploading the image.';
        exit;
    }

    if ($pname == '' || $pcat == '' || $pbrand == '' || $pprice == '' || $pdesc == '' || $pimg == '') {
        echo 'One or more fields are empty';
    } else {
        $conn = getDB();
        $sql = 'INSERT into products (product_name, product_category, product_brand, product_price, product_description, product_image) VALUES (?,?,?,?,?,?)';
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt === false) {
            echo mysqli_error($conn);
        } else {
            mysqli_stmt_bind_param($stmt, 'ssssss', $pname, $pcat, $pbrand, $pprice, $pdesc, $pimg);
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
<h1>Admin- Add new product</h1>
    <label for="product_name">Product Name:</label> <br>
    <input type="text" name="product_name" id=""> <br>
    <label for="product_category">Product Category:</label> <br>
    <input type="text" name="product_category" id=""> <br>
    <label for="product_brand">Product Brand:</label> <br>
    <input type="text" name="product_brand" id=""> <br>
    <label for="product_price">Product Price:</label> <br>
    <input type="text" name="product_price" id=""> <br>
    <label for="product_description">Product Description:</label> <br>
    <input type="text" name="product_description" id=""> <br>
    <label for="product_image">Image File:</label> <br>
    <input type="file" name="product_image" id=""> <br> <br>
    <div class="adminbtnflex">
    <button type="submit" class="adminbtn">Add product</button> <br>
    <a href="adminHome.php" class="adminbtn">Cancel</a>
    </div>
    
</form>

    </div>
</div>


