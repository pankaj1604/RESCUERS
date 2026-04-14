<?php
require_once '../connect.php';

// Get patient_id from URL
if (!isset($_GET['id'])) {
    echo "Invalid request";
    exit();
}

$patient_id = $_GET['id'];

// Fetch patient info
$p_sql = "SELECT * FROM patient WHERE patient_id='$patient_id'";
$p_res = $conn->query($p_sql);
$patient = $p_res->fetch_assoc();

// Fetch health profile
$h_sql = "SELECT * FROM health_profile WHERE patient_id='$patient_id'";
$h_res = $conn->query($h_sql);
$profile = $h_res->fetch_assoc();

$profile_id = $profile['profile_id'] ?? null;

// Fetch child data
$allergies = [];
$conditions = [];
$medications = [];
$contacts = [];

if ($profile_id) {

    $res = $conn->query("SELECT allergy FROM allergies WHERE profile_id='$profile_id'");
    while ($row = $res->fetch_assoc()) $allergies[] = $row['allergy'];

    $res = $conn->query("SELECT e_condition FROM existing_conditions WHERE profile_id='$profile_id'");
    while ($row = $res->fetch_assoc()) $conditions[] = $row['e_condition'];

    $res = $conn->query("SELECT medication FROM medications WHERE profile_id='$profile_id'");
    while ($row = $res->fetch_assoc()) $medications[] = $row['medication'];

    $res = $conn->query("SELECT e_phone FROM e_contact WHERE profile_id='$profile_id'");
    while ($row = $res->fetch_assoc()) $contacts[] = $row['e_phone'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Profile</title>
    <link rel="stylesheet" href="patient_profile.css">
    <link rel="stylesheet" href="../Homepage/style.css">
</head>

<body>

<!-- Navbar -->
 <?php include "../navbar.php" ?>

<!-- ================= PROFILE HEADER ================= -->
<div class="vp-container">

    <div class="vp-header">
        <h2><?php echo $patient['name']; ?></h2>
        <p><?php echo $patient['email']; ?></p>
    </div>

    <!-- ================= HEALTH INFO ================= -->
    <div class="vp-card">
        <h3>Health Profile</h3>

        <div class="vp-grid">

            <div class="vp-item">
                <span>Blood Group</span>
                <p><?php echo $profile['blood_group'] ?? 'N/A'; ?></p>
            </div>

            <div class="vp-item">
                <span>Address</span>
                <p><?php echo $profile['address'] ?? 'N/A'; ?></p>
            </div>

            <div class="vp-item">
                <span>Whatsapp</span>
                <p><?php echo $patient['whatsapp_num'] ?? 'N/A'; ?></p>
            </div>

            <div class="vp-item">
                <span>Emergency Contacts</span>
                <p><?php echo implode(', ', $contacts) ?: 'N/A'; ?></p>
            </div>

            <div class="vp-item">
                <span>Allergies</span>
                <p><?php echo implode(', ', $allergies) ?: 'N/A'; ?></p>
            </div>

            <div class="vp-item">
                <span>Diagnosed With</span>
                <p><?php echo implode(', ', $conditions) ?: 'N/A'; ?></p>
            </div>

            <div class="vp-item">
                <span>Medications</span>
                <p><?php echo implode(', ', $medications) ?: 'N/A'; ?></p>
            </div>

        </div>
    </div>

</div>

<!-- Footer -->
 <?php include "../footer.php" ?>

</body>
</html>