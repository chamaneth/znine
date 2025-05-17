<?php
// Simulating order data (in a real application, this would be fetched from a database)
$orders = [
    ['id' => 12345, 'customer' => 'John Doe', 'status' => 'Pending', 'date' => '2025-04-25', 'total' => 100],
    ['id' => 12346, 'customer' => 'Jane Smith', 'status' => 'Shipped', 'date' => '2025-04-22', 'total' => 150],
    ['id' => 12347, 'customer' => 'Mark Lee', 'status' => 'Completed', 'date' => '2025-04-20', 'total' => 200],
    // Add more sample orders here
];

$currentUrl = $_SERVER['REQUEST_URI']; // Get full URL path
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Order Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f6f8;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: white;
            color: black;
            padding: 2rem 1rem;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
        }

        .sidebar h2 {
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }

        .sidebar h2 span {
            color: gray;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 0.5rem;
        }

        .sidebar a {
            text-decoration: none;
            color: inherit;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            transition: background-color 0.2s;
        }

        .sidebar a:hover {
            background-color: #d3d3d3; /* Light grey on hover */
        }

        .sidebar a.active {
            background-color: #d3d3d3; /* Light grey when active */
        }

        .icon {
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }

        .dashboard {
            padding: 2rem;
            margin-left: 250px;
            flex-grow: 1;
        }

        .search-filter {
            margin-bottom: 1rem;
        }

        .search-filter input, .search-filter select {
            width: 100%;
        }

        table {
            width: 100%;
            margin-top: 2rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        table th, table td {
            padding: 1rem;
            text-align: center;
        }

        table th {
            background-color: #f8f9fa;
        }

        .analytics {
            margin-top: 50px;
        }

        .btn-info, .btn-warning, .btn-danger {
            margin: 5px;
        }

    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <h2>Welcome To <span>Admin</span></h2>
    <ul>
        <li><a href="index.php" class="<?= strpos($currentUrl, 'index.php') !== false ? 'active' : '' ?>"><i class="fas fa-chart-line icon"></i> Dashboard</a></li>
        <li><a href="product/index.php" class="<?= strpos($currentUrl, 'product/index.php') !== false ? 'active' : '' ?>"><i class="fas fa-box-open icon"></i> Product Management</a></li>
        <li><a href="user/index.php" class="<?= strpos($currentUrl, 'user/index.php') !== false ? 'active' : '' ?>"><i class="fas fa-users icon"></i> User Management</a></li>
        <li><a href="orders.php" class="<?= strpos($currentUrl, 'orders.php') !== false ? 'active' : '' ?>"><i class="fas fa-cart-shopping icon"></i> Orders</a></li>
        <li><a href="payments.php" class="<?= strpos($currentUrl, 'payments.php') !== false ? 'active' : '' ?>"><i class="fas fa-credit-card icon"></i> Payments</a></li>
        <li><a href="settings.php" class="<?= strpos($currentUrl, 'settings.php') !== false ? 'active' : '' ?>"><i class="fas fa-gear icon"></i> Settings</a></li>
        <li><a href="reviews.php" class="<?= strpos($currentUrl, 'reviews.php') !== false ? 'active' : '' ?>"><i class="fas fa-comment-dots icon"></i> Reviews</a></li>
        <li><a href="help_support.php" class="<?= strpos($currentUrl, 'help_support.php') !== false ? 'active' : '' ?>"><i class="fas fa-circle-question icon"></i> Help & Support</a></li>
    </ul>
</aside>

<!-- Main Dashboard Content -->
<div class="dashboard">
    <div class="welcome">👋 Welcome back, Admin!</div>
    <div class="datetime" id="datetime"></div>

    <!-- Search and Filter Section -->
    <div class="search-filter">
        <input type="text" id="orderSearch" placeholder="Search Orders..." class="form-control mb-3">
        <select id="orderStatusFilter" class="form-select mb-3">
            <option value="">All Orders</option>
            <option value="Pending">Pending</option>
            <option value="Shipped">Shipped</option>
            <option value="Completed">Completed</option>
        </select>
    </div>

    <!-- Orders Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Total Amount</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= $order['customer'] ?></td>
                    <td><?= $order['status'] ?></td>
                    <td><?= $order['date'] ?></td>
                    <td>$<?= number_format($order['total'], 2) ?></td>
                    <td>
                        <button class="btn btn-info">View</button>
                        <button class="btn btn-warning">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Analytics Section (for visualizing order stats) -->
    <div class="analytics">
        <h3>Orders Over Time</h3>
        <canvas id="ordersChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Real-time date and time display
    function updateDateTime() {
        const now = new Date();
        const datetime = now.toLocaleString('en-US', { dateStyle: 'full', timeStyle: 'short' });
        document.getElementById('datetime').textContent = datetime;
    }
    updateDateTime();
    setInterval(updateDateTime, 60000); // update every minute

    // Chart.js for visualizing orders
    const ctx = document.getElementById('ordersChart').getContext('2d');
    const ordersChart = new Chart(ctx, {
        type: 'line', // 'line' chart type
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr'],
            datasets: [{
                label: 'Orders',
                data: [50, 100, 150, 200], // Sample data for orders
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.1
            }]
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
