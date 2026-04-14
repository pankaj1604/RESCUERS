<?php
include '../connect.php';

if (!isset($_SESSION['volunteer_id'])) {
    header("Location: ../Login/volunteer_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard</title>
    <link rel="stylesheet" href="../Homepage/style.css">
    <link rel="stylesheet" href="volunteer_dashboard.css">
</head>

<body>

<?php include "../navbar.php"; ?>

<!-- ================= PROFILE ================= -->
<section class="v-profile-section">
    <div class="v-profile-card">
        <div>
            <h2 class="v-name"><?php echo $_SESSION['name']; ?></h2>
            <p class="v-email"><?php echo $_SESSION['email']; ?></p>
        </div>
        <a href="#" class="v-edit-btn hover-up">Edit Profile</a>
    </div>
</section>

<!-- ================= ACTIVE ALERTS ================= -->
<section class="v-alert-section">
    <div class="v-section-header">
        <h3>Active Alerts</h3>
    </div>

    <div class="v-alert-list">

        <div class="v-alert-card">
            <div class="v-alert-info">
                <h4>Aniket Kumar</h4>
                <p>Bompass Town</p>
                <span>7 Feb 2026 | 7:20 PM</span>
                <a href="#" class="v-view-profile">View Profile</a>
            </div>

            <div class="v-alert-actions">
                <span class="v-status active">Active</span>
                <button class="v-btn">Respond</button>
            </div>
        </div>

        <div class="v-alert-card">
            <div class="v-alert-info">
                <h4>Pankaj Kumar</h4>
                <p>Deoghar</p>
                <span>6 Feb 2026 | 6:10 PM</span>
                <a href="#" class="v-view-profile">View Profile</a>
            </div>

            <div class="v-alert-actions">
                <span class="v-status active">Active</span>
                <button class="v-btn">Respond</button>
            </div>
        </div>

    </div>

    <div class="v-load-more">
        <button>Load More</button>
    </div>
</section>

<!-- ================= ACCEPTED ALERTS ================= -->
<section class="v-alert-section">
    <div class="v-section-header">
        <h3>Accepted Alerts</h3>
    </div>

    <div class="v-alert-list">

        <div class="v-alert-card">
            <div class="v-alert-info">
                <h4>Ravi Kumar</h4>
                <p>Ranchi</p>
                <span>5 Feb 2026 | 5:00 PM</span>
                <a href="#" class="v-view-profile">View Profile</a>
            </div>

            <div class="v-alert-actions">
                <span class="v-status progress">In Progress</span>
                <button class="v-btn">Contact</button>
            </div>
        </div>

    </div>

    <div class="v-load-more">
        <button>Load More</button>
    </div>
</section>

<?php include "../footer.php"; ?>

</body>
</html>