<?php
require('header.php');
$conn = dbConn(); // Connect to DB

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']); // Clean the product ID

    // Update sales count +1 for the purchased product
    $updateSales = "UPDATE products SET sales = sales + 1, stock = stock - 1 WHERE id = ? AND stock > 0";
    $stmt = $conn->prepare($updateSales);
    $stmt->bind_param("i", $productId);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Success
    } else {
        // Optional: Maybe show "Out of Stock" message if needed
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Success</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f7fa;
    }
    .success-card {
      background: #ffffff;
      padding: 50px 30px;
      border-radius: 15px;
      text-align: center;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      margin-top: 80px;
    }
    .success-icon {
      font-size: 80px;
      color: #28a745;
    }
    .btn-home {
      margin-top: 20px;
      border-radius: 25px;
      padding: 10px 30px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="success-card">
        <div class="success-icon">
          <i class="fas fa-check-circle"></i>
        </div>
        <h2 class="mt-4">Payment Successful!</h2>
        <p class="text-muted">Thank you for your payment. Your order is confirmed.</p>
        <a href="index.php" class="btn btn-primary btn-home">Go to Home</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

<?php require('footer.php'); ?>

</body>
</html>
