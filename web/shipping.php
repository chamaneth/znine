<?php
require('header.php');
$conn = dbConn(); // database connection

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = 1; // You need to dynamically get the user ID if you have login system
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];
    $country = $_POST['country'];

    $stmt = $conn->prepare("INSERT INTO shipping_addresses (user_id, street_address, city, state, zip_code, country) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $street_address, $city, $state, $zip_code, $country);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: payment.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Address</title>
    <style>
        /* Only styling inside shipping-container */
        .shipping-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            
        }

        .shipping-container .shipping-form {
            display: flex;
            flex-direction: column;
        }

        .shipping-container .form-group {
            margin-bottom: 15px;
        }

        .shipping-container label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .shipping-container input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }

        .shipping-container button {
            padding: 15px;
            font-size: 16px;
            border: none;
            background-color:rgb(132, 114, 98);
            color: white;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .shipping-container button:hover {
            background-color:rgb(41, 36, 32);
        }

        @media (max-width: 768px) {
            .shipping-container {
                margin: 20px;
                padding: 20px;
            }

            .shipping-container button {
                font-size: 14px;
                padding: 12px;
            }
        }
    </style>
</head>
<body>

<div class="shipping-container my-5">
    <h2 class="text-center mb-4">Enter Shipping Address</h2>

    <form action="payment.php" method="POST" class="shipping-form">
        <div class="form-group">
            <label for="street_address">Street Address</label>
            <input type="text" id="street_address" name="street_address" required>
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" id="city" name="city" required>
        </div>

        <div class="form-group">
            <label for="state">State</label>
            <input type="text" id="state" name="state" required>
        </div>

        <div class="form-group">
            <label for="zip_code">Zip Code</label>
            <input type="text" id="zip_code" name="zip_code" required>
        </div>

        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" id="country" name="country" required>
        </div>

        <button type="submit">Submit and Continue to Payment</button>
    </form>
</div>

<?php require('footer.php'); ?>

</body>
</html>
