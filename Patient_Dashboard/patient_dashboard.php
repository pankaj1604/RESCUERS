<?php
include '../connect.php';

if (!isset($_SESSION['patient_id'])) {
    header("Location: ../Login/patient_login.php");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// Check if health profile exists
$sql = "SELECT profile_id FROM health_profile WHERE patient_id='$patient_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $health_link = "../Health_Profile/health_profile.php";
} else {
    $health_link = "../Health_Profile/add_health_profile.php";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
    <link rel="stylesheet" href="patient_dashboard.css">
    <link rel="stylesheet" href="../Homepage/style.css">
</head>

<body>

    <!-- Alert Button -->
    <?php if (isset($_SESSION['patient_id'])): ?>
        <?php include "../alert_btn.php"; ?>
    <?php endif; ?>

    <!-- Navbar -->
     <?php include "../navbar.php"; ?>

    <!-- Dashboard -->


    <!-- Profile Info -->
    <div class="profile-info-container">
        <div class="profile-info">
            <h2 class="patient-name"><?php echo $_SESSION['name']; ?></h2>
            <p class="patient-email"><?php echo $_SESSION['email']; ?></p>
            <a href="" class="edit-profile-btn">Edit Profile</a>
        </div>
        <div class="dasboard-qr-alert">
            <img src="../icons/qr-icon.svg" alt="" class="d-qr-icon">
            <a href="" class="alert-btn hover-up"><img src="../icons/alert-icon.png" alt=""> ALERT</a>
        </div>

    </div>

    <!-- Dashboard Feature Section -->
    <div class="d-feature-container">
        <a href="<?php echo $health_link; ?>" class="d-feature-box">
            <div class="d-feature-icon health-profile"></div>
            <p>Health Profile</p>
        </a>
        <a href="../Reports/reports.php" class="d-feature-box">
            <div class="d-feature-icon reports"></div>
            <p>Reports</p>
        </a>
    </div>


    <!-- Emergency Alerts -->
    <h3 class="d-title">Emergency Alerts</h3>
    <div class="p-alert-card-container">
        <div class="p-alert-card">
            <div class="patient-alert-info">
                <p>Alert Created !</p>
                <h3>Aniket Kumar</h3>
                <p class="p-address">Bompass Town</p>
                <p class="alert-date-time">7-2-2026 | 7:20 p.m.</p>
                <a href="" class="cancel-alert-btn hover-up">Cancel</a>
            </div>

            <div class="p-alert-cta">
                <div class="alert-progress hover-up">In Progress</div>
                <div class="alert-amb-cta hover-up">Call Ambulance</div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include "../footer.php"; ?>

    <a href="../Patient_Profile/patient_profile.php?id=6">View Profile</a>
</body>

</html>