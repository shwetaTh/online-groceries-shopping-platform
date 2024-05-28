<script>
    function confirmDelete(orderId) {
    if (confirm('Are you sure you want to cancel this order?')) {
        const data = new FormData();
        data.append('order_id', orderId);
        data.append('new_status', 'canceled');
        fetch('updateStatus.php', {
            method: 'POST',
            body: data
        })
        .then(response => response.text())
        .then(responseText => {
            console.log(responseText);
            if (responseText === "Status updated successfully.") {
                window.location.reload(); // Reloads the page
            } else {
                alert('Failed to cancel the order. Please try again later.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while trying to cancel the order.');
        });
    }
}
function updateStatus(orderId, newStatus) {
    const data = new FormData();
    data.append('order_id', orderId);
    data.append('new_status', newStatus);

    fetch('updateStatus.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.text())
    .then(responseText => {
        console.log(responseText);
        if (responseText === "Status updated successfully.") {
            window.location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
<?php
require 'includes/database.php';
    $conn = getDB();
    $sql = "SELECT o.order_id, o.order_date, d.user_id, d.fullname, d.city, d.street_address, d.contact, d.nearest_landmark, d.additional_message, o.status
            FROM orders o
            INNER JOIN delivery d ON o.order_id = d.order_id
            ORDER BY o.order_date DESC";
    $stmt = mysqli_prepare($conn, $sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $status_options = ['delivered', 'processing', 'approved', 'canceled', 'in delivery'];
    echo '<h2>Orders</h2>';
    echo '<table border="1">';
    echo '<tr><th>User Id</th><th>Order ID</th><th>Ordered Date</th><th>Full Name</th><th>City</th><th>Street Address</th><th>Contact</th><th>Nearest Landmark</th><th>Additional Message</th><th>Total Price</th><th>Status</th><th>Actions</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        $order_id = $row['order_id'];
        $sql = "SELECT SUM(oi.quantity * p.product_price) AS total_price
                FROM order_items oi
                INNER JOIN products p ON oi.product_id = p.product_id
                WHERE oi.order_id = ?";
        $stmt_total = mysqli_prepare($conn, $sql);
        $stmt_total->bind_param("i", $order_id);
        $stmt_total->execute();
        $result_total = $stmt_total->get_result();
        $row_total = mysqli_fetch_assoc($result_total);
        $total_price = $row_total['total_price'];

        echo '<tr>';
        echo '<td>' . $row['user_id'] . '</td>';
        echo '<td>' . $row['order_id'] . '</td>';
        echo '<td>' . $row['order_date'] . '</td>';
        echo '<td>' . $row['fullname'] . '</td>';
        echo '<td>' . $row['city'] . '</td>';
        echo '<td>' . $row['street_address'] . '</td>';
        echo '<td>' . $row['contact'] . '</td>';
        echo '<td>' . $row['nearest_landmark'] . '</td>';
        echo '<td>' . $row['additional_message'] . '</td>';
        echo '<td>' . $total_price . '</td>';
        echo '<td>';
        echo '<select onchange="updateStatus(' . $order_id .', this.value)">';
foreach ($status_options as $status_option) {
    $selected = ($row['status'] === $status_option) ? 'selected' : '';
    echo '<option value="' . $status_option . '" ' . $selected . '>' . $status_option . '</option>';
}
echo '</select>';


echo '</td>';
        echo '<td>';
        if ($row['status'] !== 'delivered' && $row['status'] !== 'canceled') {
            echo '<button onclick="confirmDelete(' . $row['order_id'] . ')">Cancel</button>';
        }
        
        echo '</td>';
        echo '<td>';
        echo '<a href="details.php?order_id='.$row['order_id']. '">Details</a>';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';

?>
