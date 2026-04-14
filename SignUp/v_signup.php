<?php
include '../connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $whatsapp = $_POST['whatsapp_num'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit();
    }

    
    $lat = $_POST['latitude'];
    $lng = $_POST['longitude'];

    if (empty($lat) || empty($lng)) {
        echo "Location is required. Please allow location access.";
        exit();
    }
    
    $sql = "INSERT INTO volunteer 
    (name, phone, whatsapp_number, address, email, password, latitude, longitude)
    VALUES 
    ('$name', '$phone', '$whatsapp', '$address', '$email', '$password', '$lat', '$lng')";

    if ($conn->query($sql)) {

        // Get inserted volunteer id
        $volunteer_id = $conn->insert_id;

        // Create session
        $_SESSION['volunteer_id'] = $volunteer_id;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;

        // Redirect to dashboard
        header("Location: ../Volunteer_Dashboard/volunteer_dashboard.php");
        exit();

    } else {
        echo "Error: " . $conn->error;
    }
}
?>