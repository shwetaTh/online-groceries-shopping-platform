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
if (isset($_POST['delete'])) {
    $conn = getDB();
    $sql = 'DELETE FROM products WHERE product_id = ?';
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        echo mysqli_error($conn);
    } else {
        mysqli_stmt_bind_param($stmt, 'i', $product_id);
        mysqli_stmt_execute($stmt);
    }
    header('Location: adminHome.php');
    exit;
}
if (isset($_POST['cancel'])){
    header('Location: adminHome.php');
    exit;
}
?>
<form action="" method="post">
    <label for="confirm">Are you sure you want to delete this product? </label>
    <button type="submit" name="delete">Delete</button>
    <button name="cancel">Cancel</button>
</form>
