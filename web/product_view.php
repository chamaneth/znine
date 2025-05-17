<?php
require('header.php');

$conn = dbConn(); // database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// Get the product ID from the URL
$product_id = isset($_GET['id']) ? $_GET['id'] : null;

// Check if product ID is provided
if ($product_id) {
    // Fetch the product details from the database
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        echo "Product not found!";
        exit;
    }
} else {
    echo "Invalid product ID.";
    exit;
}
?>
    <div class="container my-5">
        <h1 class="text-center"><?= htmlspecialchars($product['name']) ?></h1>

        <div class="row">
            <div class="col-md-6">
                <img src="<?= BASE_URL.htmlspecialchars($product['image_url']) ?>" class="img-fluid" alt="<?= htmlspecialchars($product['name']) ?>">
            </div>
            <div class="col-md-6">
                <h3>Price: <?= number_format($product['selling_price'], 2) ?> LKR</h3>
                <p><strong>Category:</strong> <?= htmlspecialchars($product['category']) ?></p>
                <p><strong>Brand:</strong> <?= htmlspecialchars($product['brand']) ?></p>
                <p><strong>Stock:</strong> <?= htmlspecialchars($product['stock']) ?> items</p>
                <p><strong>Description:</strong></p>
                <p><?= nl2br(htmlspecialchars($product['description'])) ?></p>

                <form action="cart.php" method="POST">
                    <input type="hidden" name="action" value="add">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="1" min="1" max="<?= $product['stock'] ?>" required>
                    </div>

                    <button type="submit" class="btn btn-success">Add to Cart</button>
                </form>
            </div>
        </div>

        <hr>

        <h4>Product Details</h4>
        <ul>
            <li><strong>SKU:</strong> <?= htmlspecialchars($product['sku']) ?></li>
          <!--  <li><strong>Size:</strong> <?= htmlspecialchars($product['size']) ?></li> -->
            <li><strong>Status:</strong> <?= htmlspecialchars($product['status']) ?></li>
            <li><strong>Sales:</strong> <?= $product['sales'] ?> units sold</li>
        </ul>

        <hr>

        <h4>Customer Reviews</h4>
        <p>No reviews yet. Be the first to review this product!</p>
    </div>

    <?php require('footer.php'); ?>
