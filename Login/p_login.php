<?php
include '../connect.php';

// Get form data
$login_input = $_POST['login_input'];
$password = $_POST['password'];

// Validation
if (empty($login_input) || empty($password)) {
    echo "All fields are required!";
    exit();
}

// Check user by email OR phone
$sql = "SELECT * FROM patient 
        WHERE (email='$login_input' OR phone='$login_input') 
        AND password='$password'";

$result = $conn->query($sql);

if ($result->num_rows === 1) {

    $row = $result->fetch_assoc();

    // Session
    $_SESSION['patient_id'] = $row['patient_id'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['whatsapp'] = $row['whatsapp_num'];


    // Redirect
    header("Location: ../Patient_Dashboard/patient_dashboard.php");
    exit();

} else {
    echo "Invalid credentials!";
}

$conn->close();
?>