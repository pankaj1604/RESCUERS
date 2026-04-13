<?php
include '../connect.php';

if (!isset($_SESSION['patient_id'])) {
    header("Location: ../Login/patient_login.html");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// Fetch health profile
$sql = "SELECT * FROM health_profile WHERE patient_id = '$patient_id'";
$result = $conn->query($sql);

$profile = $result->fetch_assoc();

$profile_id = $profile['profile_id'] ?? null;

// Fetch child data
$allergies = [];
$conditions = [];
$medications = [];
$contacts = [];

if ($profile_id) {

    // Allergies
    $res = $conn->query("SELECT allergy FROM allergies WHERE profile_id='$profile_id'");
    while ($row = $res->fetch_assoc()) {
        $allergies[] = $row['allergy'];
    }

    // Conditions
    $res = $conn->query("SELECT e_condition FROM existing_conditions WHERE profile_id='$profile_id'");
    while ($row = $res->fetch_assoc()) {
        $conditions[] = $row['e_condition'];
    }

    // Medications
    $res = $conn->query("SELECT medication FROM medications WHERE profile_id='$profile_id'");
    while ($row = $res->fetch_assoc()) {
        $medications[] = $row['medication'];
    }

    // Emergency Contacts
    $res = $conn->query("SELECT e_phone FROM e_contact WHERE profile_id='$profile_id'");
    while ($row = $res->fetch_assoc()) {
        $contacts[] = $row['e_phone'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Profile</title>
    <link rel="stylesheet" href="../Homepage/style.css">
    <link rel="stylesheet" href="../Patient_Dashboard/patient_dashboard.css">
    <link rel="stylesheet" href="health_profile.css">
</head>

<body>
    <!-- Navbar -->
     <?php include "../navbar.php" ?>

    <!-- Dashboard -->


    <!-- Profile Info -->
    <div class="profile-info-container">
        <div class="profile-info">
        <h2 class="patient-name"><?php echo $_SESSION['name']; ?></h2>
        <p class="patient-email"><?php echo $_SESSION['email']; ?></p>        
    </div>
        <div class="dasboard-qr-alert">
            <img src="../icons/qr-icon.svg" alt="" class="d-qr-icon">
        </div>
    </div>

    <!-- Health Profile -->
    <div class="h-profile-container">
        <div class="h-profile-inner-container">
            <div class="blood-group h-info-container">
                <div class="h-info-title">Blood Group</div>
                <div class="h-info"><?php echo $profile['blood_group'] ?? ''; ?></div>
            </div>

            <div class="address h-info-container">
                <div class="h-info-title">Address</div>
                <div class="h-info"><?php echo $profile['address'] ?? ''; ?></div>
            </div>

            <div class="whatsapp-no h-info-container">
                <div class="h-info-title">Whatsapp Number</div>
                <div class="h-info"><?php echo $_SESSION['whatsapp'] ?? ''; ?></div>
            </div>

            <div class="e-contact h-info-container">
                <div class="h-info-title">Emergency Contacts</div>
                <div class="h-info"><?php echo implode(', ', $contacts); ?></div>
            </div>

            <div class="allergies h-info-container">
                <div class="h-info-title">Allergies</div>
                <div class="h-info"><?php echo implode(', ', $allergies); ?></div>
            </div>

            <div class="diagnosed h-info-container">
                <div class="h-info-title">Diagnosed With</div>
                <div class="h-info"><?php echo implode(', ', $conditions); ?></div>
            </div>

            <div class="medication h-info-container">
                <div class="h-info-title">Medication</div>
                <div class="h-info"><?php echo implode(', ', $medications); ?></div>
            </div>
        </div>

        <a href="edit_health_profile.php" class="edit-health-profile-btn hover-up">
            Edit Health Profile
        </a>
    </div>


    <!-- Footer -->
    <?php include "../footer.php" ?>
</body>

</html>