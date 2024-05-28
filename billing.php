<?php
require 'header.php';
require 'includes/database.php';
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    $user_id = $_SESSION['user_id'];
    $conn = getDB();
    $sql = "SELECT MAX(order_id) AS latest_order_id FROM orders WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    $latest_order_id = $row['latest_order_id'];

    $sql = "SELECT o.order_id, o.order_date, d.fullname, d.city, d.street_address, d.contact, d.nearest_landmark, d.additional_message, o.status, 
            SUM(oi.quantity * p.product_price) AS total_price
            FROM orders o
            INNER JOIN delivery d ON o.order_id = d.order_id
            INNER JOIN order_items oi ON o.order_id = oi.order_id
            INNER JOIN products p ON oi.product_id = p.product_id
            WHERE o.order_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->bind_param("i", $latest_order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_assoc($result);
    echo '<h2>Thank You for Your Order</h2>';
    echo '<br>';
    echo '<table border="1">';
    echo '<tr><th>Order ID</th><th>Ordered Date</th><th>Full Name</th><th>City</th><th>Street Address</th><th>Contact</th><th>Nearest Landmark</th><th>Additional Message</th><th>Total Price</th><th>Status</th></tr>';

    echo '<tr>';
    echo '<td>' . $row['order_id'] . '</td>';
    echo '<td>' . $row['order_date'] . '</td>';
    echo '<td>' . $row['fullname'] . '</td>';
    echo '<td>' . $row['city'] . '</td>';
    echo '<td>' . $row['street_address'] . '</td>';
    echo '<td>' . $row['contact'] . '</td>';
    echo '<td>' . $row['nearest_landmark'] . '</td>';
    echo '<td>' . $row['additional_message'] . '</td>';
    echo '<td>Rs. ' . $row['total_price'] . '</td>';
    echo '<td>' . $row['status'] . '</td>';
    echo '</tr>';

    echo '</table>';
} else {
    header("Location: userlogin.php");
    exit();
}
?>
<a href="home.php" class="continue">Continue Shopping</a>
<?php require 'footer.php';?>