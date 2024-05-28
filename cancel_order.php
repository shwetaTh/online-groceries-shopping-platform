<?php
require 'header.php';
require 'includes/database.php';

// Check if the user is logged in
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
    // Get the user ID from the login session
    $user_id = $_SESSION['user_id'];

    // Check if the order_id is provided in the URL
    if (isset($_GET['order_id']) && !empty($_GET['order_id'])) {
        $order_id = $_GET['order_id'];

        // Check if the provided order_id belongs to the logged-in user
        $conn = getDB();
        $sql = "SELECT order_id FROM orders WHERE user_id = ? AND order_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        $stmt->bind_param("ii", $user_id, $order_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // The order_id belongs to the user, proceed with cancellation
            // Start a database transaction to ensure atomicity of the delete operations
            mysqli_begin_transaction($conn);

            try {
                // Delete from the delivery table
                $sql = "DELETE FROM delivery WHERE order_id = ?";
                $stmt = mysqli_prepare($conn, $sql);
                $stmt->bind_param("i", $order_id);
                $stmt->execute();

                // Delete from the order_items table
                $sql = "DELETE FROM order_items WHERE order_id = ?";
                $stmt = mysqli_prepare($conn, $sql);
                $stmt->bind_param("i", $order_id);
                $stmt->execute();

                // Delete from the orders table
                $sql = "DELETE FROM orders WHERE order_id = ?";
                $stmt = mysqli_prepare($conn, $sql);
                $stmt->bind_param("i", $order_id);
                $stmt->execute();

                // Commit the transaction
                mysqli_commit($conn);

                // Redirect the user back to the order history page with a success message
                header("Location: orderDetails.php?success=1");
                exit();
            } catch (Exception $e) {
                // An error occurred, rollback the transaction
                mysqli_rollback($conn);
                header("Location: orderDetails.php?error=1");
                exit();
            }
        } else {
            // The provided order_id does not belong to the logged-in user, redirect back to the order history page
            header("Location: orderDetails.php?error=2");
            exit();
        }
    } else {
        // order_id is not provided in the URL, redirect back to the order history page
        header("Location: orderDetails.php?error=3");
        exit();
    }
} else {
    // If the user is not logged in, redirect to the login page or show a message
    header("Location: userlogin.php");
    exit();
}
?>
