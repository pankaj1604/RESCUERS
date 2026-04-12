<?php
// Start session (optional but useful globally)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "rescuersdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>