<?php
  $currentUrl = $_SERVER['REQUEST_URI']; // Get full URL path
?>

<head>
  <!-- Link FontAwesome (free CDN version) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  
  <style>
    .sidebar {
      width: 250px;
      background-color: white;
      color: black;
      padding: 2rem 1rem;
      height: 100vh;
      position: fixed;
      top: 0;
      left: 0;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.05);
    }

    .sidebar h2 {
      font-size: 1.5rem;
      margin-bottom: 2rem;
    }

    .sidebar h2 span {
      color: gray;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
    }

    .sidebar li {
      margin-bottom: 0.5rem;
    }

    .sidebar a {
      text-decoration: none;
      color: inherit;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem 1rem;
      border-radius: 10px;
      transition: background-color 0.2s;
    }

    .sidebar a:hover {
      background-color: #d3d3d3; /* Light grey on hover */
    }

    .sidebar a.active {
      background-color: #d3d3d3; /* Light grey when active */
    }

    .icon {
      font-size: 1.2rem;
      width: 20px;
      text-align: center;
    }
  </style>
</head>

<aside class="sidebar">
  <h2>Welcome To <span>Admin</span></h2>

  <ul> <!-- Open the <ul> here -->
    <li>
      <a href="<?= SYSTEM_PATH?>index.php" class="<?= strpos($currentUrl, 'system/index.php') !== false ? 'active' : '' ?>">
        <i class="fas fa-chart-line icon"></i> Dashboard
      </a>
    </li>

    <li>
      <a href="<?= SYSTEM_PATH?>product/index.php" class="<?= strpos($currentUrl, 'system/product/index.php') !== false ? 'active' : '' ?>">
        <i class="fas fa-box-open icon"></i> Product Management
      </a>
    </li>
    <li>
      <a href="<?= SYSTEM_PATH?>user/index.php" class="<?= strpos($currentUrl, 'system/user/index.php') !== false ? 'active' : '' ?>">
        <i class="fas fa-users icon"></i> User Management
      </a>
    </li>
    <li>
      <a href="<?= SYSTEM_PATH?>orders.php" class="<?= strpos($currentUrl, 'orders.php') !== false ? 'active' : '' ?>">
        <i class="fas fa-cart-shopping icon"></i> Orders
      </a>
    </li>
    <li>
      <a href="<?= SYSTEM_PATH?>payments.php" class="<?= strpos($currentUrl, 'payments.php') !== false ? 'active' : '' ?>">
        <i class="fas fa-credit-card icon"></i> Payments
      </a>
    </li>
    <li>
      <a href="<?= SYSTEM_PATH?>setting.php" class="<?= strpos($currentUrl, 'settings.php') !== false ? 'active' : '' ?>">
        <i class="fas fa-gear icon"></i> Setting
      </a>
    </li>
    <li>
      <a href="<?= SYSTEM_PATH?>reviews.php" class="<?= strpos($currentUrl, 'reviews.php') !== false ? 'active' : '' ?>">
        <i class="fas fa-comment-dots icon"></i> Reviews
      </a>
    </li>
    <li>
      <a href="<?= SYSTEM_PATH?>help_support.php" class="<?= strpos($currentUrl, 'help_support.php') !== false ? 'active' : '' ?>">
        <i class="fas fa-circle-question icon"></i> Help & Support
      </a>
    </li>

    <li>
    <a href="logout.php" class="<?= strpos($currentUrl, 'logout.php') !== false ? 'active' : '' ?>">
        <i class="fas fa-sign-out-alt icon"></i> Sign Out
    </a>
</li>
  </ul> <!-- Close the <ul> here -->

</aside>
