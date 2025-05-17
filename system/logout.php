<?php 
include 'init.php'; // Include the initialization file
session_start(); // Start the session

// Destroy all session data
session_unset(); 

// Destroy the session
session_destroy(); 

// Redirect the user to the home page or login page
header('Location: '.WEB_APP_PATH.'login.php'); 
exit();
?>
