<?php
require('header.php');
?>

    <title>Reviews Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
</head>
<body>


<!-- Main Content -->
<div class="dashboard">
    <div class="welcome">👋 Welcome back, Admin!</div>
    <div class="datetime" id="datetime"></div>
    <!-- Reviews Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Review ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Rating</th>
                <th>Review</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Reviews Data (this would normally come from the database) -->
            <tr>
                <td>101</td>
                <td>John Doe</td>
                <td>Product A</td>
                <td>4/5</td>
                <td>Great product, will buy again.</td>
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
