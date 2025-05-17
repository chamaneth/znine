<?php 

require_once('header.php');

if (isset($_SESSION['user'])) {
    header('Location: index.php');  // Redirect to the home page if the user is already logged in
    exit();
}




if(isset($_POST['login'])) {
    
    $conn = dbConn(); // database connection
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user from database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user found
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
    
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user; // Start session
    
            // Redirect based on role
            if (isset($user['role']) && $user['role'] === 'admin') {
                // Redirect to admin page (correct path based on your folder structure)
                header("Location: /znine/system/");  // Full path from root (make sure this path is correct)
            } else {
                // Redirect to user's index page (correct path based on your folder structure)
                header("Location: /znine/web/index.php");  // Full path from root (make sure this path is correct)
            }
            exit;
        } else {
            echo "<script>alert('Invalid password.'); window.location.href = '".WEB_APP_PATH."login.php';</script>";
        }
    } else {
        echo "<script>alert('No account found with that email.'); window.location.href = '".WEB_APP_PATH."login.php';</script>";
    }
    
    $stmt->close();

}


?>
    <div class="form-wrapper">
        <h1>Login</h1>
        <p>Please enter your Email and Password</p>
        <form action="" method="POST" class="form-container">
            <input type="email" name="email" placeholder="E - mail" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
        <p>New Customer? <a href="signup.html">Sign up here</a></p>
    </div>
</body>
</html>
