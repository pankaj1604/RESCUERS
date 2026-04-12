<?php
include 'connect.php';

// Destroy session
session_unset();
session_destroy();

// Redirect to home page
header("Location: Homepage/index.php");
exit();
?>