<?php
require('../header.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn = dbConn();

    $firstName = $_POST['first_name'];
    $lastName  = $_POST['last_name'];
    $email     = $_POST['email'];
    $role      = $_POST['role'];

    $userN     = !empty($_POST['User_N']) ? $_POST['User_N'] : '';
    $address   = !empty($_POST['Address']) ? $_POST['Address'] : '';
    $zCode     = !empty($_POST['z_code']) ? $_POST['z_code'] : '';
    $password  = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    $status    = !empty($_POST['status']) ? $_POST['status'] : 'active';

    // Basic validation for required fields
    if ($firstName && $lastName && $email && $role) {
        $sql = "INSERT INTO users (User_N, first_name, last_name, email, Address, z_code, password, role, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            'sssssssss',
            $userN, $firstName, $lastName, $email, $address, $zCode, $password, $role, $status
        );

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>User added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error adding user: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Please fill in all required fields.</div>";
    }
}
?>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <div class="card">
        <div class="card-header">
          <h3>Add New User</h3>
        </div>
        <div class="card-body">
          <form method="POST">
            <div class="mb-3">
              <label for="User_N" class="form-label">Username</label>
              <input type="text" class="form-control" name="User_N" />
            </div>

            <div class="mb-3">
              <label for="first_name" class="form-label">First Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="first_name" required />
            </div>

            <div class="mb-3">
              <label for="last_name" class="form-label">Last Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" name="last_name" required />
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
              <input type="email" class="form-control" name="email" required />
            </div>

            <div class="mb-3">
              <label for="Address" class="form-label">Address</label>
              <input type="text" class="form-control" name="Address" />
            </div>

            <div class="mb-3">
              <label for="z_code" class="form-label">Zip Code</label>
              <input type="text" class="form-control" name="z_code" />
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" />
            </div>

            <div class="mb-3">
              <label for="role" class="form-label">Role<span class="text-danger">*</span></label>
              <select class="form-select" name="role" required>
                <option value="">Select Role</option>
                <option value="admin">Admin</option>
                <option value="customer">Customer</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-select" name="status">
                <option value="active" selected>Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>

            <button type="submit" class="btn btn-primary">Add User</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>
