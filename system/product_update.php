<?php
include('php/db.php');

// Handle Update
if (isset($_POST['update'])) {
    $id = $_POST['product_no'];
    $name = $_POST['product_name'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $price = $_POST['selling_price']; // using selling_price as main price
    $image_url = null;

    // Handle image upload
    if (isset($_FILES['images']) && $_FILES['images']['error'][0] == 0) {
        $uploadDir = 'uploads/';
        $imageName = basename($_FILES['images']['name'][0]);
        $targetPath = $uploadDir . $imageName;
        move_uploaded_file($_FILES['images']['tmp_name'][0], $targetPath);
        $image_url = $targetPath;
    }

    $sql = "UPDATE product SET name=?, description=?, price=?, category=?, image_url=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdssi", $name, $description, $price, $category, $image_url, $id);

    if ($stmt->execute()) {
        echo "Product updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Handle Delete
if (isset($_POST['delete'])) {
    $id = $_POST['product_no'];

    $sql = "DELETE FROM product WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
