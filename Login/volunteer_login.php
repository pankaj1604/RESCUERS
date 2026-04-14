<?php
include '../connect.php';

// If patient is logged in
if (isset($_SESSION['patient_id'])) {
    header("Location: ../Patient_Dashboard/patient_dashboard.php");
    exit();
}

// If volunteer is logged in
if (isset($_SESSION['volunteer_id'])) {
    header("Location: ../Volunteer_Dashboard/volunteer_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Volunteer</title>
    <link rel="stylesheet" href="../SignUp/signup.css">
    <link rel="stylesheet" href="../Homepage/style.css">
</head>

<body>
    <!-- Navbar -->
    <?php include "../navbar.php" ?>

    <!-- Sign Up -->
    <div class="signup-container">
        <div class="signup-title">
            <h3>Login</h3>
            <p>as Volunteer</p>
        </div>
        <form method="POST" action="v_login.php">
            <label>Email or Phone</label>
            <input type="text" name="login_id" placeholder="Enter email or phone" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <input type="submit" value="Login" class="submit-btn">
        </form>
        <p class="form-cta">Don't have an account? <a href="../SignUp/volunteer_signup.php">Sign Up</a></p>
    </div>


    <!-- Footer -->
    <?php include "../footer.php" ?>
</body>

</html>