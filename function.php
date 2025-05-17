<?php

function dbConn() {
    $servername = "localhost";
    $username = "root";
    $password = ""; // Your database password
    $dbname = "ninety6_db"; // Your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
?>
