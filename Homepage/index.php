<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include "../navbar.php"; ?>

    <!-- Hero Section -->
    <div class="hero-container">
        <h2 class="hero-title">In an <span>Emergency</span>, Every <span>Second Matters.</span></h2>
        <p class="hero-desc">Get instant emergency help, and safely store all your health information.</p>

        <?php if (!isset($_SESSION['patient_id'])): ?>
        <div class="hero-btn-container">
            <div class="hero-btns" id="hero-sign-in-btn">
                <p>Sign In</p>

                <div class="sign-options" id="sign-in-opt">
                    <a href="../Login/patient_login.php">Patient</a>
                    <a href="../Login/volunteer_login.php">Volunteer</a>
                </div>
            </div>

            <div class="hero-btns" id="hero-sign-up-btn">
                <p>Sign Up</p>

                <div class="sign-options" id="sign-up-opt">
                    <a href="../SignUp/patient_signup.php">Patient</a>
                    <a href="../SignUp/volunteer_signup.php">Volunteer</a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- <a href="#" class="alert-btn"><img src="../icons/alert-icon.png" alt=""> ALERT</a> -->


        <div class="hero-big-circle">
            <div class="hero-small-circle"></div>
        </div>
        <img src="../images/volunteer_red.png" alt="" class="hero-men">
    </div>

    <!-- Explore Cards -->
    <div class="cards-container">
        <!-- Patient Card -->
        <div class="explore-cards">
            <div class="explore-card-title">
                <span>For</span><br> Patient
            </div>
            <a href="#" class="explore-card-btn">
                Explore
            </a>

            <img src="../images/patient.png" alt="" class="explore-card-img">
    </div>

        <!-- Volunteer Card -->
        <div class="explore-cards">
            <div class="explore-card-title">
                <span>For</span><br> Volunteer
            </div>
            <a href="#" class="explore-card-btn">
                Explore
            </a>

            <img src="../images/volunteer2.png" alt="" class="explore-card-img">
        </div>
    </div>

    <!-- About Section -->
    <div class="sec-title-container">
        <p class="sec-sub-title">ABOUT</p>
        <h3 class="sec-title">RESCUERS</h3>
    </div>

    <div class="about-container">
        <p>
            Rescuers is a reliable emergency-response platform for real-life situations. Whether you’re alone, away from
            home, or need urgent medical help, it instantly alerts nearby volunteers/NGOs and connects you to the
            nearest hospital—
        </p>
        <h4>“Because help should never be out of reach.”</h4>
        <a href="" class="about-btn">Know More</a>

        <img src="../images/emergencyHelping.png" alt="">
    </div>

    <!-- Features Section -->
    <div class="sec-title-container">
        <p class="sec-sub-title">OUR</p>
        <h3 class="sec-title">FEATURES</h3>
    </div>

    <div class="feature-card-container">
        <div class="feature-card">
            <img src="../icons/feature_icons/emergency_alert.png" alt="" class="feature-card-icon">
            <h4 class="feature-card-title">Emergency Alerts</h4>
            <p class="feature-card-desc">Instant alerts to nearby volunteers</p>
        </div>
        <div class="feature-card">
            <img src="../icons/feature_icons/Health_Profile.png" alt="" class="feature-card-icon">
            <h4 class="feature-card-title">Health Profile</h4>
            <p class="feature-card-desc">Store essential medical information</p>
        </div>
        <div class="feature-card">
            <img src="../icons/feature_icons/report_storage.png" alt="" class="feature-card-icon">
            <h4 class="feature-card-title">Report Storage</h4>
            <p class="feature-card-desc">Upload and access medical reports</p>
        </div>
        <div class="feature-card">
            <img src="../icons/feature_icons/volunteer_network.png" alt="" class="feature-card-icon">
            <h4 class="feature-card-title">Volunteer Network</h4>
            <p class="feature-card-desc">Connect with nearby helpers</p>
        </div>
        <div class="feature-card">
            <img src="../icons/feature_icons/hospital_finder.png" alt="" class="feature-card-icon">
            <h4 class="feature-card-title">Hospital Finder</h4>
            <p class="feature-card-desc">Locate nearby hospitals quickly</p>
        </div>
        <div class="feature-card">
            <img src="../icons/feature_icons/Ambulance_support.png" alt="" class="feature-card-icon">
            <h4 class="feature-card-title">Ambulance Support</h4>
            <p class="feature-card-desc">Quick call for ambulance help</p>
        </div>
    </div>

    <!-- Register CTA -->
    <?php if (!isset($_SESSION['patient_id'])): ?>
    <div class="register-cta-container">
        <div class="register-cta-title">
            <h3>BE PREPARED FOR EMERGENCIES</h3>
            <p>Join Rescuers today and ensure that help is always within reach when you need it the most.</p>
        </div>
        <div class="register-btn-container">
            <div class="register-cta">
                <img src="../images/patient.png" alt="">
                <a href="../SignUp/patient_signup.php">Register as Patient</a>
            </div>
            <div class="register-cta">
                <img src="../images/volunteer2.png" alt="">
                <a href="../SignUp/volunteer_signup.html">Register as Volunteer</a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Footer -->
     <?php include "../footer.php"; ?>


    <!-- javascript -->
    <script src="index.js"></script>
</body>

</html>