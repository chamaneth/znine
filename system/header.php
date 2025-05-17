<?php
session_start();

require('init.php'); 
// Check if the user is not logged in or the user's role is not "admin"
if (!isset($_SESSION['user'])) {
    header('Location:'.WEB_APP_PATH.'login.php');  // Redirect to login page if not logged in or not an admin
    exit();
}

if (isset($_SESSION['user']) && $_SESSION['user']['role'] !== 'admin') {
    header('Location:'.WEB_APP_PATH.'not_authorized.php');  // Redirect to login page if not logged in or not an admin
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Optional external CSS -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f6f8;
            display: flex;
        }

        .dashboard {
            padding: 2rem;
            margin-left: 250px; /* offset for sidebar */
            flex-grow: 1;
        }

        .welcome {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .datetime {
            font-size: 1rem;
            color: gray;
            margin-bottom: 2rem;
        }

        .cards {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .card {
            background: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            min-width: 200px;
            flex: 1;
        }

        .card h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .card p {
            font-size: 1.8rem;
            font-weight: bold;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>

<?php include 'sidebar.php'; ?> <!-- Sidebar included -->