<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Patient</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php include "../navbar.php"; ?>

    <!-- Sign Up -->
    <div class="signup-container">
        <div class="signup-title">
            <h3>Sign Up</h3>
            <p>as Patient</p>
        </div>
        <form action="p_signup.php" method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Pankaj Kumar" required>

            <label for="email">Email</label>
            <input type="email" name="email" placeholder="demo1234@gmail.com" required>

            <label for="phone">Phone</label>
            <input type="text" name="phone" required pattern="[0-9]{10}" title="Enter 10 digit number">

            <label for="password">Password</label>
            <input type="password" name="password" required minlength="4">

            <label for="confirm-password">Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <input type="submit" value="Sign Up" class="submit-btn">
        </form>
        <p class="form-cta">Already have an account? <a href="../Login/patient_login.html">Login</a></p>
    </div>


    <!-- Footer -->
     <?php include "../footer.php"; ?>

</body>

</html>