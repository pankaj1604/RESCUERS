<?php

include "../connect.php";

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validation
if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
    echo "All fields are required!";
    exit();
}

if ($password !== $confirm_password) {
    echo "Passwords do not match!";
    exit();
}

// Insert into database
$sql = "INSERT INTO patient (name, email, phone, password) 
        VALUES ('$name', '$email', '$phone', '$password')";

if ($conn->query($sql) === TRUE) {

    // Get last inserted user ID
    $patient_id = $conn->insert_id;

    // Create session
    $_SESSION['patient_id'] = $patient_id;
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;

    // Redirect to dashboard
    header("Location: ../Patient_Dashboard/patient_dashboard.php");
    exit();

} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>