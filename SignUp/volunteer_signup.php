<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Volutneer</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="../Homepage/style.css">
</head>

<body>
    <?php include "../navbar.php" ?>

    <!-- Sign Up -->
    <div class="signup-container">
        <div class="signup-title">
            <h3>Sign Up</h3>
            <p>as Volutneer</p>
        </div>
        <form method="POST" action="v_signup.php">
            <label>Name</label>
            <input type="text" name="name" placeholder="Pankaj Kumar" required>

            <label>Phone</label>
            <input type="text" name="phone" required>

            <label>Whatsapp Number</label>
            <input type="text" name="whatsapp_num" required>

            <label>Address</label>
            <input type="text" name="address" required>

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

            <label>Email</label>
            <input type="text" name="email" placeholder="demo1234@gmail.com" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <input type="submit" value="Sign Up" class="submit-btn">
        </form>
        <p class="form-cta">Already have an account? <a href="../Login/volunteer_login.php">Login</a></p>
    </div>

    <!-- Footer -->
    <?php include "../footer.php" ?>


    <!-- Javascript -->
     <script>
        window.onload = function () {

            if (navigator.geolocation) {

                navigator.geolocation.getCurrentPosition(
                    function (position) {

                        document.getElementById("latitude").value = position.coords.latitude;
                        document.getElementById("longitude").value = position.coords.longitude;

                    },
                    function (error) {
                        alert("Please allow location access to continue.");
                    }
                );

            } else {
                alert("Geolocation is not supported by your browser.");
            }
        };
    </script>

</body>

</html>