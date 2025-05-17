<?php

session_start(); // Start the session
require('../system/init.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ninety6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/botui/build/botui.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/botui/build/botui.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/botui/build/botui-theme-default.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=IM+FELL+Great+Primer+SC&display=swap" rel="stylesheet">
    <style>
        .topbanner {
            background-color: #f8f9fa;
            padding: 10px 0;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
            color: #333;
        }
        
  #botui-app {
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 300px;
    max-width: 90%;
    z-index: 1000;
  }
</style>

    </style>
</head>

<body>


    <div class="top-banner">
        We Ship to <span id="shipping-countries"></span>
    </div>

    <script>
        // Array of countries
        const shippingCountries = ["Sri Lanka", "India", "Maldives", "USA", "UK", "Australia", "Canada"];

        // Join countries with commas
        const countriesList = shippingCountries.join(', ');

        // Update the content dynamically
        document.getElementById("shipping-countries").textContent = countriesList;
    </script>


    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-blue shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="index.php">NINETY6</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item"><a class="nav-link" href="product.php">SHOP ALL</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="men.php" id="boysLink">MEN</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="women.php" id="girlsLink">WOMEN</a>
                    </li>

                    <li class="nav-item"><a class="nav-link" href="#">GIF CARDS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">DISCOUNT</a></li>
                    <li class="nav-item"><a class="nav-link" href="account_details.php">MY ACCOUNT</a></li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2 search-box" type="search" placeholder="Search Products...">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>
                <a href="<?php echo isset($_SESSION['user']) ? WEB_APP_PATH.'logout.php' : 'login.php'; ?>"
                    class="btn btn-outline-dark ms-3 <?= isset($_SESSION['user']) ? 'logged-in' : 'logged-out'; ?>">
                    <i class="fa-regular fa-user user-icon"></i>
                </a>
                <a href="cart.php" class="btn btn-outline-dark ms-2">
                    <i class="fa-solid fa-cart-shopping"></i>
                </a>
            </div>
        </div>
    </nav>

</body>