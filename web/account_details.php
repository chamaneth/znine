<?php


require('header.php');  // Include necessary files (like db connection)


if (!isset($_SESSION['user'])) {
  header('Location: login.php');  // Redirect to login page if not logged in
  exit();
}
// Check if the user is already logged in
$user_data = $_SESSION['user'];  // Access the user data stored in the session

$user_id = $user_data['email']; // Assuming 'email' stores user data in session

// Create a connection to the database
$conn = dbConn();  // Initialize database connection
if (!$conn) {
  die("Database connection failed: " . mysqli_connect_error());
}

// Fetch user data from the database
$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$user_id'");
$user = mysqli_fetch_assoc($result);

// Check if user data is found
if (!$user) {
  die("User not found.");
}

$_SESSION['profile_updated'] = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $action = $_POST['action'];
  $user_id = $_POST['user_id'];

  // Connect to the database
  $conn = dbConn();

  if ($action == 'profile') {
    // Profile Update
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    // Update without profile picture
    $query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name' WHERE id = $user_id";

    mysqli_query($conn, $query);
    
    $_SESSION['profile_updated'] = true;
  }

  if ($action == 'password') {
    // Password Change
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
      // Check current password
      $result = mysqli_query($conn, "SELECT password FROM users WHERE id = $user_id");
      $user = mysqli_fetch_assoc($result);

      if (password_verify($current_password, $user['password'])) {
        // Update password
        $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET password = '$new_password_hashed' WHERE id = $user_id");
      } else {
        echo "Current password is incorrect.";
      }
    } else {
      echo "New passwords do not match.";
    }
  }

  if ($action == 'delete') {
    // Delete Account
    mysqli_query($conn, "UPDATE users SET status='deleted' WHERE id = $user_id");
    session_destroy();
    header("Location: login.php");  // Redirect after account deletion
    exit();
  }
}


?>

<div class="container mt-5">
  <h2 class="text-center mb-4">Account Settings</h2>

  <!-- Personal Information Section -->
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card">
        <div class="card-header bg-primary text-white">
          <h5>Personal Information</h5>
        </div>
        <div class="card-body">
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="profile">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

            <!-- First Name -->
            <div class="mb-3">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
            </div>

            <!-- Last Name -->
            <div class="mb-3">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
          </form>
        </div>
      </div>

      <!-- Delete Account Button -->
      <form action="update_account.php" method="POST" class="mt-3">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?')">Delete Account</button>
      </form>
    </div>
  </div>

  <!-- Security Information Section -->
  <div class="row mt-4">
    <div class="col-md-6 mx-auto">
      <div class="card">
        <div class="card-header bg-warning text-white">
          <h5>Security Information</h5>
        </div>
        <div class="card-body">
          <form action="update_account.php" method="POST">
            <input type="hidden" name="action" value="password">
            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">

            <!-- Current Password -->
            <div class="mb-3">
              <label for="current_password" class="form-label">Current Password</label>
              <input type="password" class="form-control" id="current_password" name="current_password" required>
            </div>

            <!-- New Password -->
            <div class="mb-3">
              <label for="new_password" class="form-label">New Password</label>
              <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>

            <!-- Confirm New Password -->
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm New Password</label>
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>

            <button type="submit" class="btn btn-warning">Change Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript">
        window.onload = function() {
            // Check if the session variable is set (indicating profile update)
            <?php if (isset($_SESSION['profile_updated']) && $_SESSION['profile_updated'] === true) { ?>
                // Reload the page once
                location.reload();
                // Clear the session flag to prevent repeated reloads
                <?php unset($_SESSION['profile_updated']); ?>
            <?php } ?>
        };
    </script>
<?php require('footer.php');?>