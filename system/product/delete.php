<?php
require('../header.php');

// Fetch product data
if (isset($_GET['id'])) {
  $productId = intval($_GET['id']);
  $conn = dbConn();

  $sql = "SELECT * FROM products WHERE id = $productId";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    $product = $result->fetch_assoc();
  } else {
    echo "<div class='alert alert-danger'>Product not found.</div>";
    exit;
  }
} else {
  echo "<div class='alert alert-danger'>Invalid Request.</div>";
  exit;
}

// Handle confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['confirm'])) {
    // Soft delete: Set stock = 0
    $deleteSql = "UPDATE products SET status='deleted' WHERE id = $productId";
    if ($conn->query($deleteSql)) {
      header('Location: ' . SYSTEM_PATH . 'product/index.php?message=deleted');
      exit;
    } else {
      echo "<div class='alert alert-danger'>Error deleting product: " . $conn->error . "</div>";
    }
  } else {
    header('Location: ' . SYSTEM_PATH . 'product/index.php');
    exit;
  }
}
?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header">
          <h3>Delete Product</h3>
        </div>
        <div class="card-body">
          <h2 class="mb-4">Delete Product</h2>
          <p>Are you sure you want to delete <strong><?= htmlspecialchars($product['name']) ?></strong>?</p>

          <form method="POST">
            <button type="submit" name="confirm" class="btn btn-danger">Yes, Delete</button>
            <button type="submit" name="cancel" class="btn btn-secondary">Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
