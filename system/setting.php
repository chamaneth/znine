<?php
require('header.php');  // Include the header file which contains the database connection

// Database connection (ensure this is done properly in header.php)
$settingsQuery = "SELECT * FROM settings WHERE id = 1"; 
$settingsResult = $conn->query($settingsQuery);

if ($settingsResult && $settingsResult->num_rows > 0) {
    $settings = $settingsResult->fetch_assoc();
} else {
    // Handle error or no data case
    $settings = ['site_title' => '', 'site_description' => ''];
}

// If form is submitted to update settings
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $siteTitle = $_POST['site_title'];
    $siteDescription = $_POST['site_description'];

    // Update settings in the database
    $updateQuery = "UPDATE settings SET site_title = ?, site_description = ? WHERE id = 1";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ss", $siteTitle, $siteDescription);
    $stmt->execute();

    // Check if update was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>alert('Settings updated successfully!');</script>";
    } else {
        echo "<script>alert('No changes made.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Settings</title>
    <link rel="stylesheet" href="../style.css"> <!-- Your existing CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-size: 1.1em;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            font-size: 1em;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            color: green;
            font-size: 1.1em;
            margin-top: 20px;
            text-align: center;
        }

        .alert-error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin Settings</h1>

        <!-- Alert messages -->
        <?php if (isset($settingsUpdated)): ?>
            <div class="alert"><?= $settingsUpdated ?></div>
        <?php endif; ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="site_title">Site Title:</label>
                <input type="text" id="site_title" name="site_title" value="<?= htmlspecialchars($settings['site_title']) ?>" required>
            </div>

            <div class="form-group">
                <label for="site_description">Site Description:</label>
                <textarea id="site_description" name="site_description" required><?= htmlspecialchars($settings['site_description']) ?></textarea>
            </div>

            <div class="form-group">
                <button type="submit">Save Settings</button>
            </div>
        </form>
    </div>
</body>
</html>
