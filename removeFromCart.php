<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productId"])) {
    $productId = $_POST["productId"];
    $cartItems = isset($_SESSION['cartItems']) ? json_decode($_SESSION['cartItems']) : [];

    $cartItems = array_diff($cartItems, [$productId]);

    $_SESSION['cartItems'] = json_encode(array_values($cartItems));

    echo "Product removed from cart successfully";
}
?>
