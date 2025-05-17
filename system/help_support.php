<?php
require('header.php');
?>

    <title>Help & Support</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
</head>
<body>



<!-- Main Content -->
<div class="dashboard">
    <div class="welcome">👋 Welcome back, Admin!</div>
    <h3>Help & Support</h3>
    
    <p>If you have any questions or issues, please feel free to reach out to our support team.</p>
      <div class="datetime" id="datetime"></div>
    <form>
        <div class="mb-3">
            <label for="supportEmail" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="supportEmail" placeholder="Enter your email">
        </div>
        <div class="mb-3">
            <label for="supportQuery" class="form-label">Your Query</label>
            <textarea class="form-control" id="supportQuery" rows="4" placeholder="Describe your issue or question"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Query</button>
    </form>
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
