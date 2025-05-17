<?php
require('../header.php');

// Fetch products from database
$conn = dbConn();
$sql = "SELECT * FROM products WHERE status != 'deleted'"; // Example condition
$result = $conn->query($sql);
?>

<div class="dashboard">
  <h2 class="mb-4">Product Management</h2>
  <div class="datetime" id="datetime"></div>

  <!-- Add Product Button -->
  <div class="row">
    <div class="col-md-6">
      <a href="add.php" class="btn btn-primary btn-sm mb-3">Add Product</a>
    </div>
  </div>

  <?php if ($result->num_rows > 0): ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
          <tr>
            <th>Name</th>
            <th>Brand</th>
            <th>Category</th>
            <th>Price (Rs)</th>
            <th>Selling Price (Rs)</th>
            <th>Stock</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['name']) ?></td>
              <td><?= htmlspecialchars($row['brand']) ?></td>
              <td><?= htmlspecialchars($row['category']) ?></td>
              <td><?= htmlspecialchars(number_format($row['regular_price'], 2)) ?></td>
              <td><?= htmlspecialchars(number_format($row['selling_price'], 2)) ?></td>
              <td><?= htmlspecialchars($row['stock']) ?></td>
              <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">No products found.</div>
  <?php endif; ?>
</div>

<script>
    function updateDateTime() {
        const now = new Date();
        const datetime = now.toLocaleString('en-US', { dateStyle: 'full', timeStyle: 'short' });
        document.getElementById('datetime').textContent = datetime;
    }
    updateDateTime();
    setInterval(updateDateTime, 60000); // update every minute
</script>

</body>
</html>
