<?php
require('../header.php');

if (isset($_GET['id'])) {
  $customerId = $_GET['id'];

  // Fetch customer data
  $conn = dbConn();
  $sql = "SELECT * FROM users WHERE id = $customerId";
  $result = $conn->query($sql);
  $customer = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  print_r($_POST);
  $firstName = $_POST['first_name'];
  $lastName = $_POST['last_name'];
  $email = $_POST['email'];
  $status = $_POST['status'];

  // Update customer data
  $updateSql = "UPDATE users SET first_name='$firstName', last_name='$lastName', email='$email', status='$status' WHERE id = $customerId";
  if ($conn->query($updateSql) === TRUE) {
    echo "<div class='alert alert-success'>User updated successfully!</div>";
  } else {
    echo "<div class='alert alert-danger'>Error updating user: " . $conn->error . "</div>";
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
          <form method="POST">
            <div class="mb-3">
              <label for="first_name" class="form-label">First Name</label>
              <input type="text" class="form-control" name="first_name" value="<?= htmlspecialchars($customer['first_name']) ?>" required />
            </div>

            <div class="mb-3">
              <label for="last_name" class="form-label">Last Name</label>
              <input type="text" class="form-control" name="last_name" value="<?= htmlspecialchars($customer['last_name']) ?>" required />
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($customer['email']) ?>" required />
            </div>

            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-select" aria-label="user status" name="status">
                <option value="active" <?= $customer['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                <option value="inactive" <?= $customer['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Update User</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>

</html>