<?php 
require('header.php'); 
require_once($_SERVER['DOCUMENT_ROOT'].'/znine/function.php'); 

// Connect to the database
$conn = dbConn();

// Fetch total number of products
$sqlTotalProducts = "SELECT COUNT(*) AS total_products FROM products";
$resultTotalProducts = $conn->query($sqlTotalProducts);
$totalProducts = $resultTotalProducts->fetch_assoc()['total_products'] ?? 0;

// Fetch total number of orders
$sqlTotalOrders = "SELECT COUNT(*) AS total_orders FROM orders";
$resultTotalOrders = $conn->query($sqlTotalOrders);
$totalOrders = $resultTotalOrders->fetch_assoc()['total_orders'] ?? 0;

// Fetch total number of customers
$sqlTotalCustomers = "SELECT COUNT(*) AS total_customers FROM users";
$resultTotalCustomers = $conn->query($sqlTotalCustomers);
$totalCustomers = $resultTotalCustomers->fetch_assoc()['total_customers'] ?? 0;

// Fetch total revenue
$sqlTotalRevenue = "
    SELECT SUM(oi.quantity * p.selling_price) AS total_revenue
    FROM order_items oi
    JOIN products p ON oi.product_id = p.id
";
$resultTotalRevenue = $conn->query($sqlTotalRevenue);
$totalRevenue = $resultTotalRevenue->fetch_assoc()['total_revenue'] ?? 0;

// Fetch order status counts for line chart
$sqlOrderStatus = "
    SELECT order_status, COUNT(*) as count 
    FROM orders 
    GROUP BY order_status
";
$resultOrderStatus = $conn->query($sqlOrderStatus);

$orderStatuses = [];
$orderCounts = [];
while ($row = $resultOrderStatus->fetch_assoc()) {
    $orderStatuses[] = $row['order_status'];
    $orderCounts[] = $row['count'];
}

$conn->close();
?>

<div class="dashboard">
    <div class="welcome">👋 Welcome back, Admin!</div>
    <div class="datetime" id="datetime"></div>

    <div class="cards">
        <div class="card">
            <h3>Total Products</h3>
            <p><?= htmlspecialchars($totalProducts) ?></p>
        </div>
        <div class="card">
            <h3>Total Orders</h3>
            <p><?= htmlspecialchars($totalOrders) ?></p>
        </div>
        <div class="card">
            <h3>Total Customers</h3>
            <p><?= htmlspecialchars($totalCustomers) ?></p>
        </div>
        <div class="card">
            <h3>Total Revenue</h3>
            <p>$<?= number_format($totalRevenue, 2) ?></p>
        </div>
    </div>

    <div class="analyzer" style="margin-top: 50px;">
        <h2>📊 Order Status Overview</h2>
        <canvas id="orderStatusChart" width="400" height="100"></canvas>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function updateDateTime() {
        const now = new Date();
        const datetime = now.toLocaleString('en-US', { dateStyle: 'full', timeStyle: 'short' });
        document.getElementById('datetime').textContent = datetime;
    }
    updateDateTime();
    setInterval(updateDateTime, 60000); // update every minute

    // Chart.js Line Chart
    const ctx = document.getElementById('orderStatusChart').getContext('2d');
    const orderStatusChart = new Chart(ctx, {
        type: 'line', // Changed to 'line'
        data: {
            labels: <?= json_encode($orderStatuses) ?>,
            datasets: [{
                label: 'Order Status Count',
                data: <?= json_encode($orderCounts) ?>,
                fill: false,
                borderColor: '#36A2EB',
                tension: 0.1, // Smooth the line
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Order Status'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Count'
                    },
                    beginAtZero: true
                }
            }
        }
    });
</script>

<?php require('footer.php'); ?>
