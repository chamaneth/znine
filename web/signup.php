<?php
include('header.php');


// Ensure the connection is established
$conn = dbConn(); // Make sure the dbConn() function is defined and returns a valid connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $first_name = htmlspecialchars(trim($_POST['first_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check for existing email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "Email is already registered.";
        exit;
    }

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $first_name, $last_name, $email, $hashed_password);

    if ($stmt->execute()) {
        // Registration success, redirect to login
        header("Location: php/login.php");
        exit; // Make sure the script stops here to avoid further execution
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!-- The form (HTML part) -->
<div class="form-wrapper">
    <h1>Sign Up</h1>
    <p>Please enter your details to create an account</p>
    <form action="" method="POST" class="form-container">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Create Account</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>
</body>
</html>
