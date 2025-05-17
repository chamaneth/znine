<?php

include $_SERVER["DOCUMENT_ROOT"]."/znine/function.php";


// Connect to the database
$conn = dbConn();

// Fetch total number of users
$sqlUsers = "SELECT COUNT(*) AS total_users FROM users";
$resultUsers = $conn->query($sqlUsers);
$totalUsers = $resultUsers->fetch_assoc()['total_users'];

// Fetch total number of products
$sqlProducts = "SELECT COUNT(*) AS total_products FROM products";
$resultProducts = $conn->query($sqlProducts);
$totalProducts = $resultProducts->fetch_assoc()['total_products'];

// Fetch total number of orders
$sqlOrders = "SELECT COUNT(*) AS total_orders FROM orders";
$resultOrders = $conn->query($sqlOrders);
$totalOrders = $resultOrders->fetch_assoc()['total_orders'];

$sqlRevenue = "SELECT SUM(p.price * oi.quantity) AS total_revenue
               FROM orders o
               JOIN order_items oi ON o.order_id = oi.order_id
               JOIN products p ON oi.product_id = p.id";



$resultRevenue = $conn->query($sqlRevenue);
$totalRevenue = $resultRevenue->fetch_assoc()['total_revenue'];

$sqlTopSellingProducts = "
    SELECT name, sales 
    FROM products 
    ORDER BY sales DESC 
    LIMIT 5
";
$resultTopSellingProducts = $conn->query($sqlTopSellingProducts);


// Close the connection
$conn->close();
?>


<body>
  <nav>
    <h1>Welcome Back, Admin!</h1>
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

  <div class="container">
    <div class="sidebar">
      
    <ul>
    <li><i class="fas fa-chart-line icon"></i> <a href="dashboard.php">Overview</a></li>
    <li><i class="fas fa-box-open icon"></i> <a href="product/index.php">Products</a></li>
    <li class="active"><i class="fas fa-users icon"></i> <a href="user/index.php">User Management</a></li>
    <li><i class="fas fa-cart-shopping icon"></i> <a href="orders.php">Orders</a></li>
    <li><i class="fas fa-credit-card icon"></i> <a href="payments.php">Payments</a></li>
    <li><i class="fas fa-gear icon"></i> <a href="settings.php">Settings</a></li>
    <li><i class="fas fa-comment-dots icon"></i> <a href="reviews.php">Reviews</a></li>
    <li><i class="fas fa-circle-question icon"></i> <a href="help_support.php">Help & Support</a></li>
</ul>
    

        <!-- Main Content -->
        <div class="container3">
            <div class="title">Overview Dashboard</div>

            <div class="stats">
                <div class="stat-item">
                    <h3>Total Users</h3>
                    <p><?= $totalUsers ?></p>
                </div>
                <div class="stat-item">
                    <h3>Total Products</h3>
                    <p><?= $totalProducts ?></p>
                </div>
                <div class="stat-item">
                    <h3>Total Orders</h3>
                    <p><?= $totalOrders ?></p>
                </div>
                <div class="stat-item">
                    <h3>Total Revenue</h3>
                    <p>$<?= number_format($totalRevenue ?? 0, 2) ?></p>

                </div>
            </div>

            <div class="top-selling">
                <h3>Top Selling Products</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Total Sales</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php if ($resultTopSellingProducts->num_rows > 0): ?>
        <?php while ($row = $resultTopSellingProducts->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['sales']) ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="2">No sales data available</td>
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
