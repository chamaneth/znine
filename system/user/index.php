<?php
require('../header.php');

// Fetch users from database
$conn = dbConn();
$sql = "SELECT * FROM users WHERE status != 'deleted'";
$result = $conn->query($sql);
?>

<div class="dashboard">
  <h2 class="mb-4">User Management</h2>
  <div class="datetime" id="datetime"></div>
  <div class="row">
    <div class="col-md-6">
      <a href="add.php" class="btn btn-primary mb-3">Add User</a>
    </div>
  </div>

  <?php if ($result->num_rows > 0): ?>
    <div class="table-responsive">
      <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
              <td><?= htmlspecialchars($row['email']) ?></td>
              <td><?= htmlspecialchars($row['role']) ?></td>
              <td><?= htmlspecialchars($row['status']) ?></td>
              <td>
                <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>"  class="btn btn-sm btn-danger">Delete</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <div class="alert alert-info">No users found.</div>
  <?php endif; ?>
</div>
<script>
    function updateDateTime() {
        const now = new Date();
        const datetime = now.toLocaleString('en-US', { dateStyle: 'full', timeStyle: 'short' });
        document.getElementById('datetime').textContent = datetime;
    }
    updateDateTime();
    setInterval(updateDateTime, 60000); // update every minute
</script>
</body>

</html>