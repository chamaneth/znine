<?php 
session_start();  // Start the session at the very top of the page
require('../system/init.php');  // Include necessary files (like db connection)

// Check if the user is already logged in


$user_id = $_SESSION['email'];  // Assuming 'email' stores user data in session

// Create a connection to the database
$conn = dbConn();  // Initialize database connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch user data from the database
$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_id'");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Account Settings</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="account-container">
    <h2>Personal Information</h2>

    <!-- Profile Picture & Name -->
    <form action="update_account.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="action" value="profile">
      <label>Full Name: <input type="text" name="fullname" value="<?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>"></label><br>
      <label>Upload Picture: <input type="file" name="profile_pic"></label><br>
      <label>Country/Region: <input type="text" name="country" value="<?= htmlspecialchars($user['country']) ?>"></label><br>
      <button type="submit">Edit Profile</button>
    </form>

    <!-- Delete Account -->
    <form action="update_account.php" method="POST">
      <input type="hidden" name="action" value="delete">
      <button type="submit" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
    </form>

    <!-- Other forms for security, email, password changes -->
    <h2>Security Information</h2>
    <!-- More forms... -->

  </div>
</body>
</html>
