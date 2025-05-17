<?php
require('header.php');
?>


    <title>Payments Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    


<!-- Main Content -->
<div class="dashboard">
    <div class="welcome">👋 Welcome back, Admin!</div>
    <div class="datetime" id="datetime"></div>
    <!-- Payment Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Order ID</th>
                <th>Payment Status</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Payments Data (this would normally come from the database) -->
            <tr>
                <td>98765</td>
                <td>12345</td>
                <td>Completed</td>
                <td>$100.00</td>
                <td>2025-04-25</td>
                <td>
                    <button class="btn btn-info">View</button>
                    <button class="btn btn-warning">Edit</button>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>
            <!-- More rows as needed -->
        </tbody>
    </table>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
