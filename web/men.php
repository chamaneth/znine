<?php
require "header.php";

// Database connection
$conn = mysqli_connect("localhost", "root", "", "ninety6_db"); // Adjust your DB credentials

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Sample Product Query - Fetch products under "Men" category
$query = "SELECT * FROM products WHERE category = 'Men'"; // Assuming 'category' column exists in the database
$result = mysqli_query($conn, $query);

// Fetch all products into an array
$products_men = [];
while ($row = mysqli_fetch_assoc($result)) {
    $products_men[] = $row;
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
    $sizes = ['06', '08', '10', '12', '14']; // Define available sizes
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
                        <a href="product_view.php?product_id=<?php echo $product['name']; ?>" class="view-product-btn">View Product</a>
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
$filtered_products = filterProducts($products_men, $selected_sizes);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Men's Clothing</title>
    <style>
       * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }

        .container {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        /* Left Side - Filters */
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

        /* Right Side - Products */
        .products-area {
            flex: 1;
        }

        .product-header {
            margin-bottom: 20px;
        }

        .product-header h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .browse-size {
            margin-bottom: 15px;
        }

        .size-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 8px;
        }

        .size-btn {
            padding: 6px 16px;
            border-radius: 30px;
            border: 1px solid #000;
            background: #fff;
            cursor: pointer;
            font-size: 14px;
        }

        .size-guide-link {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            font-size: 14px;
            text-decoration: none;
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
        .product {
    background: #fff;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ddd;
    text-align: center;
    display: flex;         /* Add these */
    flex-direction: column;
    justify-content: space-between;
}

.product img {
    width: 100%;
    height: 220px; /* bit more height */
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
