<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["productId"])) {
        $productId = $_POST["productId"];
        addToCart($productId);
    }
}

function addToCart($productId) {

    $cartItems = isset($_SESSION['cartItems']) ? json_decode($_SESSION['cartItems'], true) : [];
    $cartItems[] = $productId;

    $_SESSION['cartItems'] = json_encode($cartItems);
    print_r($cartItems);
}
?>
