<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login_id = $_POST['login_id'];
    $password = $_POST['password'];

    // Check using email OR phone
    $sql = "SELECT * FROM volunteer 
            WHERE (email='$login_id' OR phone='$login_id') 
            AND password='$password'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        // Create session
        $_SESSION['volunteer_id'] = $row['volunteer_id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['email'] = $row['email'];

        // Redirect to dashboard
        header("Location: ../Volunteer_Dashboard/volunteer_dashboard.php");
        exit();

    } else {
        echo "Invalid login credentials!";
    }
}
?>