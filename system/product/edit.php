<?php
require('../header.php');

if (isset($_GET['id'])) {
  $productId = intval($_GET['id']);

  // Fetch product data
  $conn = dbConn();
  $sql = "SELECT * FROM products WHERE id = $productId";
  $result = $conn->query($sql);
  $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $name = $_POST['name'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $sellingPrice = $_POST['selling_price'];
  $stock = $_POST['stock'];
  $brand = $_POST['brand'];
  $category = $_POST['category'];
  $sku = $_POST['sku'];

  // Update product data
  $updateSql = "UPDATE products SET 
                  name='$name',
                  description='$description',
                  regular_price='$price',
                  selling_price='$sellingPrice',
                  stock='$stock',
                  brand='$brand',
                  category='$category',
                  sku='$sku'
                WHERE id = $productId";
  if ($conn->query($updateSql) === TRUE) {
    echo "<div class='alert alert-success'>Product updated successfully!</div>";
  } else {
    echo "<div class='alert alert-danger'>Error updating product: " . $conn->error . "</div>";
  }
}
?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-8 offset-md-2">
      <div class="card">
        <div class="card-header">
          <h3>Edit Product</h3>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="mb-3">
              <label for="name" class="form-label">Product Name</label>
              <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product['name']) ?>" required />
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" name="description" rows="4" required><?= htmlspecialchars($product['description']) ?></textarea>
            </div>

            <div class="mb-3">
              <label for="price" class="form-label">Regular Price (Rs)</label>
              <input type="number" step="0.01" class="form-control" name="price" value="<?= htmlspecialchars($product['regular_price']) ?>" required />
            </div>

            <div class="mb-3">
              <label for="selling_price" class="form-label">Selling Price (Rs)</label>
              <input type="number" step="0.01" class="form-control" name="selling_price" value="<?= htmlspecialchars($product['selling_price']) ?>" required />
            </div>

            <div class="mb-3">
              <label for="stock" class="form-label">Stock</label>
              <input type="number" class="form-control" name="stock" value="<?= htmlspecialchars($product['stock']) ?>" required />
            </div>

            <div class="mb-3">
              <label for="brand" class="form-label">Brand</label>
              <input type="text" class="form-control" name="brand" value="<?= htmlspecialchars($product['brand']) ?>" required />
            </div>

            <div class="mb-3">
              <label for="category" class="form-label">Category</label>
              <input type="text" class="form-control" name="category" value="<?= htmlspecialchars($product['category']) ?>" required />
            </div>

            <div class="mb-3">
              <label for="sku" class="form-label">SKU</label>
              <input type="text" class="form-control" name="sku" value="<?= htmlspecialchars($product['sku']) ?>" required />
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
