<?php

require "../header.php";

// Connect to the database
$conn = dbConn();

// Fetch total number of orders
$sqlTotalOrders = "SELECT COUNT(*) AS total_orders FROM orders";
$resultTotalOrders = $conn->query($sqlTotalOrders);
$totalOrders = $resultTotalOrders->fetch_assoc()['total_orders'];

// Fetch total number of pending orders
$sqlPendingOrders = "SELECT COUNT(*) AS pending_orders FROM orders WHERE order_status = 'pending'";
$resultPendingOrders = $conn->query($sqlPendingOrders);
$pendingOrders = $resultPendingOrders->fetch_assoc()['pending_orders'];

// Fetch total number of completed orders
$sqlCompletedOrders = "SELECT COUNT(*) AS completed_orders FROM orders WHERE order_status = 'completed'";
$resultCompletedOrders = $conn->query($sqlCompletedOrders);
$completedOrders = $resultCompletedOrders->fetch_assoc()['completed_orders'];

// Fetch order details along with customer info and product info
$sqlOrderDetails = "
    SELECT o.order_id, o.order_date, o.order_status, u.first_name, u.last_name, u.email, p.name AS product_name, oi.quantity
FROM orders o
JOIN users u ON o.user_id = u.id
JOIN order_items oi ON o.order_id = oi.order_id
JOIN products p ON oi.product_id = p.id
ORDER BY o.order_date DESC

";
$resultOrderDetails = $conn->query($sqlOrderDetails);

// Close the connection
$conn->close();
?>

  <nav>
    <h1>Welcome Back, Admin!</h1>
    <div class="datetime" id="datetime"></div>
    <div class="search-box float-end">
      <i class="fas fa-search text-muted"></i>
      <form method="POST" action="">
        <input type="text" name="search" placeholder="Search Users..." />
        <button type="submit">Search</button>
      </form>
    </div>
    <div class="nav-item">
      <a class="nav-link" href="#">Home</a>
      <a class="nav-link" href="#">Back</a>
    </div>
  </nav>


        <!-- Main Content -->
        <div class="container3">
            <div class="title">Orders Dashboard</div>

            <!-- Stats Section -->
            <div class="stats">
                <div class="stat-item">
                    <h3>Total Orders</h3>
                    <p><?= $totalOrders ?></p>
                </div>
                <div class="stat-item">
                    <h3>Pending Orders</h3>
                    <p><?= $pendingOrders ?></p>
                </div>
                <div class="stat-item">
                    <h3>Completed Orders</h3>
                    <p><?= $completedOrders ?></p>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="order-details">
                <h3>All Orders</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultOrderDetails->num_rows > 0): ?>
                            <?php while ($row = $resultOrderDetails->fetch_assoc()): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['order_id']) ?></td>
                                    <td><?= htmlspecialchars($row['order_date']) ?></td>
                                    <td><?= htmlspecialchars($row['order_status']) ?></td>
                                    <td><?= htmlspecialchars($row['first_name']) . ' ' . htmlspecialchars($row['last_name']) ?><br><a href="mailto:<?= htmlspecialchars($row['email']) ?>"><?= htmlspecialchars($row['email']) ?></a></td>
                                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                                    <td><?= htmlspecialchars($row['quantity']) ?></td>
                                    <td>$<?= number_format($row['total_price'] ?? 0, 2) ?></td>


                                    <td class="actions">
                                        <a href="mark_completed.php?order_id=<?= $row['order_id'] ?>">Mark as Completed</a> | 
                                        <a href="delete_order.php?order_id=<?= $row['order_id'] ?>">Delete</a> | 
                                        <a href="view_order.php?order_id=<?= $row['order_id'] ?>">View</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No orders available</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
