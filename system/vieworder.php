<?php
// Include database connection
include $_SERVER["DOCUMENT_ROOT"]."/znine/function.php";

// Get customer ID from URL
$customerId = $_GET['customer_id'];

// Fetch orders of the customer
$conn = dbConn();
$sql = "SELECT * FROM orders WHERE customer_id = $customerId";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Customer Orders</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <nav>
    <h1>Customer Orders</h1>
  </nav>

  <div class="container">
    <div class="sidebar">
      <h2>Welcome Admin</h2>
    </div>

    <div class="container3">
      <div class="title">Orders for Customer ID: <?= htmlspecialchars($customerId) ?></div>
      <div class="header-bar">
        <div class="header order-id">Order ID</div>
        <div class="header product-name">Product Name</div>
        <div class="header quantity">Quantity</div>
        <div class="header price">Price</div>
      </div>

      <div class="content-area">
        <?php if ($result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <div class="row">
              <div class="cell order-id"><?= htmlspecialchars($row['order_id']) ?></div>
              <div class="cell product-name"><?= htmlspecialchars($row['product_name']) ?></div>
              <div class="cell quantity"><?= htmlspecialchars($row['quantity']) ?></div>
              <div class="cell price"><?= htmlspecialchars($row['price']) ?></div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No orders found for this customer.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
