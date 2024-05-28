<?php
require 'header.php';
require 'includes/database.php';
$conn =getDB();
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
  $user_id = $_SESSION['user_id'];
  $username = $_SESSION['username'];
  $cartItems = isset($_SESSION['cartItems']) ? json_decode($_SESSION['cartItems'], true) : [];
    $fullName = $_POST['full_name'];
    $city = $_POST['city'];
    $street_address = $_POST['street_address'];
    $contact = $_POST['contact'];
    $nearest_landmark = $_POST['nearest_landmark'];
    $additional_message = $_POST['additional_message'];


  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "INSERT INTO orders (user_id) VALUES (?)";
  $stmt = mysqli_prepare($conn, $sql);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();

  $order_id = $stmt->insert_id;
  foreach ($cartItems as $product_id) {
    $quantity = array_count_values($cartItems);

    $sql = "SELECT * FROM order_items WHERE user_id = ? AND product_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $sql = "UPDATE order_items SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        $stmt->bind_param("iii", $quantity, $user_id, $product_id);
        $stmt->execute();
    } else {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("iii", $order_id, $product_id, $quantity);
    $stmt->execute();
    }

  }
    $sql = "INSERT INTO delivery (user_id, order_id, fullname, city, street_address, contact, nearest_landmark, additional_message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
$stmt->bind_param("iissssss", $user_id, $order_id, $fullName, $city, $street_address, $contact, $nearest_landmark, $additional_message);
$stmt->execute();

  $_SESSION['cartItems'] = json_encode([]);

  header("Location: billing.php");
  exit();
} else {
  header("Location: userlogin.php");
  exit();
}
?>
