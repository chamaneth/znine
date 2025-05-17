<?php
include '../system/init.php';

session_start();  // Start the session

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect the user to the login page after logging out
header('Location: '.WEB_APP_PATH.'login.php'); 
exit;
?>
