<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Patient</title>
    <link rel="stylesheet" href="../SignUp/signup.css">
    <link rel="stylesheet" href="../Homepage/style.css">
</head>

<body>

    <?php include "../navbar.php"; ?>

    <!-- Login -->
    <div class="signup-container">
        <div class="signup-title">
            <h3>Login</h3>
            <p>as Patient</p>
        </div>
        <form action="p_login.php" method="POST">
            <label>Email or Phone</label>
            <input type="text" name="login_input" placeholder="Enter email or phone" required>

            <label>Password</label>
            <div>
                <input type="password" name="password" id="password" required>
            </div>

            <input type="submit" value="Login" class="submit-btn">
        </form>
        <p class="form-cta">Don't have an account? <a href="../SignUp/patient_signup.php">Sign Up</a></p>
    </div>



    <!-- Footer -->
     <?php include "../footer.php"; ?>

    <!-- Javascript -->

    <script>
        const togglePassword = document.getElementById("togglePassword");
        const password = document.getElementById("password");

        togglePassword.addEventListener("click", function () {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
        });
    </script>
</body>

</html>