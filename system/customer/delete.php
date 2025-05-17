<?php
require('../header.php');

// Fetch user data
if (isset($_GET['id'])) {
  $userId = intval($_GET['id']);
  $conn = dbConn();

  $sql = "SELECT * FROM users WHERE id = $userId";
  $result = $conn->query($sql);

  if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
  } else {
    echo "<div class='alert alert-danger'>User not found.</div>";
    exit;
  }
} else {
  echo "<div class='alert alert-danger'>Invalid Request.</div>";
  exit;
}

// Handle confirmation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['confirm'])) {
    // Soft delete: Set status to 'deleted'
    $deleteSql = "UPDATE users SET status='deleted' WHERE id = $userId";
    if ($conn->query($deleteSql)) {
      header('Location: view_user.php?message=deleted');
      exit;
    } else {
      echo "<div class='alert alert-danger'>Error deleting user: " . $conn->error . "</div>";
    }
  } else {
    header('Location: ' . SYSTEM_PATH . 'user/index.php');
    exit;
  }
}
?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header">
          <h3>Edit User</h3>
        </div>
        <div class="card-body">
          <h2 class="mb-4">Delete User</h2>
          <p>Are you sure you want to delete <strong><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></strong>?</p>

          <form method="POST">
            <button type="submit" name="confirm" class="btn btn-danger">Yes, Delete</button>
            <button type="submit" name="cancel" class="btn btn-secondary">Cancel</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>

</html>