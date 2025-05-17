<?php
require('../header.php');  // Include header for the page

$successMessage = "";  // Variable to hold success message
$showAlert = false;  // Flag to trigger JavaScript alert

if (isset($_POST['save'])) {
    // Database connection
    $conn = dbConn();
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize and collect form inputs
    $product_name   = mysqli_real_escape_string($conn, $_POST['product_name'] ?? '');
    $description    = mysqli_real_escape_string($conn, $_POST['description'] ?? '');
    $category       = mysqli_real_escape_string($conn, $_POST['category'] ?? '');
    $brand          = mysqli_real_escape_string($conn, $_POST['brand'] ?? '');
    $sku            = mysqli_real_escape_string($conn, $_POST['sku'] ?? '');
    $stock          = mysqli_real_escape_string($conn, $_POST['stock'] ?? '');
    $regular_price  = mysqli_real_escape_string($conn, $_POST['regular_price'] ?? '');
    $selling_price  = mysqli_real_escape_string($conn, $_POST['selling_price'] ?? '');

    // Image upload
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/znine/uploads/";  // Upload directory path
    $imagePath = "";

    if (!empty($_FILES['images']['name'])) {
        $file_name = basename($_FILES['images']['name']);
        $file_name = preg_replace('/\s+/', '', $file_name);  // Remove any spaces in the file name
        $tmp_name = $_FILES['images']['tmp_name'];
        $target_file = $upload_dir . $file_name;

        // Validate file type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png'];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($tmp_name, $target_file)) {
                // Use relative path after upload
                $imagePath = "uploads/" . $file_name;
            } else {
                echo "Failed to upload: " . $file_name . "<br>";
            }
        } else {
            echo "Invalid file type for: " . $file_name . "<br>";
        }
    }

    // Insert product into database
    $query = "INSERT INTO products (name, description, category, brand, sku, stock, regular_price, selling_price, image_url) 
              VALUES ('$product_name', '$description', '$category', '$brand', '$sku', '$stock', '$regular_price', '$selling_price', '$imagePath')";

    if (mysqli_query($conn, $query)) {
        // Set flag to trigger JavaScript alert
        $showAlert = true;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
}
?>

<!-- HTML Form -->
<html>
<head>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <style>
            /* General Form Styling */
            .form-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
        }

        .form-left, .form-right {
            width: 48%;
            padding: 20px;
        }

        .form-left {
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .form-right {
            background-color: #f8f9fa;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-inline {
            display: flex;
            justify-content: space-between;
        }

        .form-inline .form-group {
            width: 48%;
        }

        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        textarea {
            height: 120px;
            resize: none;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Light Beige and Brown Button Styles */
        .btn-light-beige {
            background-color: #f5f5dc; /* Beige */
            color: #5c4033; /* Brown text */
            border: 1px solid #d4c6b2; /* Lighter brown border */
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Hover and Focus Effects for Beige Button */
        .btn-light-beige:hover,
        .btn-light-beige:focus {
            background-color: #e3d9b5; /* Slightly darker beige */
            color: #3e2a1d; /* Darker brown text */
            border-color: #a6895f; /* Darker brown border */
        }

        /* Darker Brown Button */
        .btn-dark-brown {
            background-color: #8b5e3c; /* Dark brown */
            color: #fff; /* White text */
            border: 1px solid #7a4a29; /* Darker brown border */
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        /* Hover and Focus Effects for Dark Brown Button */
        .btn-dark-brown:hover,
        .btn-dark-brown:focus {
            background-color: #7a4a29; /* Slightly darker brown */
            border-color: #5d3720; /* Even darker brown border */
        }
    </style>
</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pt-4">
    <h2 class="mb-4">Add Product</h2>

    <!-- Form for product addition -->
    <form class="form-wrapper" method="POST" enctype="multipart/form-data" action="">
        <div class="form-left">
            <div class="form-group"><label>Product Name</label>
                <input class="form-control" type="text" name="product_name" placeholder="Product name" required />
            </div>

            <div class="form-group"><label>Description</label>
                <textarea class="form-control" name="description" placeholder="Product description" required></textarea>
            </div>

            <div class="form-group"><label>Category</label>
                <input class="form-control" type="text" name="category" required />
            </div>

            <div class="form-group"><label>Brand Name</label>
                <input class="form-control" type="text" name="brand" required />
            </div>

            <div class="form-inline">
                <div class="form-group"><label>SKU</label>
                    <input class="form-control" type="text" name="sku" required />
                </div>
                <div class="form-group"><label>Stock Quantity</label>
                    <input class="form-control" type="number" name="stock" required />
                </div>
            </div>

            <div class="form-inline">
                <div class="form-group"><label>Regular Price</label>
                    <input class="form-control" type="number" name="regular_price" step="0.0001" required />
                </div>
                <div class="form-group"><label>Selling Price</label>
                    <input class="form-control" type="number" name="selling_price" step="0.0001" required />
                </div>
            </div>
        </div>

        <div class="form-right">
            <div class="form-group">
                <label>Product Image</label>
                <input class="form-control" type="file" name="images" accept=".png,.jpg,.jpeg" />
            </div>

            <!-- Save Button -->
            <button type="submit" name="save" class="btn btn-light-beige">SAVE</button>

            <!-- Cancel Button -->
            <button type="reset" class="btn btn-light-beige">CANCEL</button>
        </div>
    </form>
</main>

<!-- JavaScript to show the alert -->
<script type="text/javascript">
    <?php if ($showAlert): ?>
        alert("New product added successfully");
    <?php endif; ?>
</script>

<?php require('../footer.php'); ?>
</body>
</html>
