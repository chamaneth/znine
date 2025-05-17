<?php
require "header.php";

// Database connection
$conn = mysqli_connect("localhost", "root", "", "ninety6_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all products (you can change query if needed)
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

$products = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

// Filter Logic
$selected_sizes = isset($_GET['size']) ? $_GET['size'] : [];

function filterProducts($products, $selected_sizes) {
    $filtered = [];
    foreach ($products as $product) {
        if (empty($selected_sizes) || in_array($product['size'], $selected_sizes)) {
            $filtered[] = $product;
        }
    }
    return $filtered;
}

function renderFilter($selected_sizes) {
    $sizes = ['06', '08', '10', '12', '14'];
    ?>
    <div class="filter">
        <h2>Product Lists</h2>
        <div class="price">
            <h4>PRICE</h4>
            <p>The Highest Price is LKR 12800.00</p>
            <div class="price-inputs">
                <input type="number" placeholder="Rs">
                -
                <input type="number" placeholder="Rs">
            </div>
        </div>
        <form method="GET" action="">
            <div class="size">
                <h4>SIZE</h4>
                <?php
                foreach ($sizes as $size) {
                    $checked = in_array($size, $selected_sizes) ? 'checked' : '';
                    ?>
                    <div><label><input type='checkbox' name='size[]' value='<?php echo $size; ?>' <?php echo $checked; ?>> <?php echo $size; ?></label></div>
                    <?php
                }
                ?>
            </div>
            <button type="submit" class="filter-btn">Apply</button>
        </form>
    </div>
    <?php
}

function renderProducts($products) {
    ?>
    <div class="product-header">
        <a href="https://www.sizeguide.net/" class="size-guide-link" target="_blank">Size Guide</a>
        <p class="showing">Showing <?php echo count($products); ?> Products</p>
    </div>
    <div class="product-grid">
        <?php
        if (!empty($products)) {
            foreach ($products as $product) {
                ?>
                <div class="product">
                    <img src="/znine/<?php echo htmlspecialchars($product['image_url']); ?>" alt="Product Image" class="product-image">
                    <div class="product-info">
                        <h4><?php echo $product['name']; ?></h4>
                        <p class="price">LKR <?php echo number_format($product['selling_price'], 2); ?></p>
                        <a href="product_view.php?product_id=<?php echo urlencode($product['id']); ?>" class="view-product-btn">View Product</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>
    <?php
}

// After functions
$filtered_products = filterProducts($products, $selected_sizes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Clothing Products</title>
    <style>
        /* Basic Reset */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }

        /* Container */
        .container {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        /* Filter Sidebar */
        .filter {
            width: 250px;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .filter h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .price, .size {
            margin-bottom: 30px;
        }

        .price-inputs input {
            width: 40%;
            margin: 5px 5px 5px 0;
            padding: 5px;
        }

        .size div {
            margin: 5px 0;
        }

        .filter-btn {
            margin-top: 10px;
            padding: 8px;
            width: 100%;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Products Area */
        .products-area {
            flex: 1;
        }

        .product-header {
            margin-bottom: 20px;
        }

        .product-header a.size-guide-link {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .showing {
            margin-top: 10px;
            font-size: 14px;
            color: #666;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 20px;
        }

        /* Product Card */
        .product {
            background: #fff;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .product:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .product img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 6px;
            margin-bottom: 10px;
        }

        .product-info h4 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .price {
            font-weight: bold;
            color: #000;
        }

        .view-product-btn {
            display: inline-block;
            margin-top: 8px;
            padding: 6px 12px;
            background-color: #000;
            color: #fff;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
        }

        .view-product-btn:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

<div class="container">
    <?php renderFilter($selected_sizes); ?>
    <div class="products-area">
        <?php renderProducts($filtered_products); ?>
    </div>
</div>

</body>
</html>
