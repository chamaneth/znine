<?php

include('header.php');
$conn = dbConn();

// Function to add an item to the cart
function addToCart($product_id, $quantity = 1) {
    // Check if cart exists in session, if not create an empty cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if product already exists in the cart
    if (isset($_SESSION['cart'][$product_id])) {
        // Increase the quantity if product exists
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Get product details from the database (product name, price)
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();

        // Add new product to the cart
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity
        ];
    }
}

// Function to remove an item from the cart
function removeFromCart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

// Handle actions (add to cart, remove from cart)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        if ($_POST['action'] == 'add') {
            addToCart($_POST['product_id'], $_POST['quantity']);
        } elseif ($_POST['action'] == 'remove') {
            removeFromCart($_POST['product_id']);
        }
    }
}

// Get cart items
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

    <div class="container">
        <h1>Your Shopping Cart</h1>
        <?php if (empty($cart_items)) { ?>
            <p>Your cart is empty. Start shopping!</p>
        <?php } else { ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $total_price = 0;
                    foreach ($cart_items as $product_id => $item) {
                        $total_price += $item['price'] * $item['quantity'];
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= number_format($item['price'], 2) ?> LKR</td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($item['price'] * $item['quantity'], 2) ?> LKR</td>
                            <td>
                                <form action="cart.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="action" value="remove">
                                    <input type="hidden" name="product_id" value="<?= $product_id ?>">
                                    <button type="submit" class="btn btn-danger">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td><strong><?= number_format($total_price, 2) ?> LKR</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="text-end">
                <a href="shipping.php" class="btn btn-success">Proceed to Checkout</a>
            </div>
        <?php } ?>
    </div>
<?php require('footer.php'); ?>
