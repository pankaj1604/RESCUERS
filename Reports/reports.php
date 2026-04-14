<?php
require_once '../connect.php';

if (!isset($_SESSION['patient_id'])) {
    header("Location: ../Login/patient_login.html");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// Fetch reports
$sql = "SELECT * FROM report WHERE patient_id='$patient_id' ORDER BY upload_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Reports</title>
    <link rel="stylesheet" href="reports.css">
    <link rel="stylesheet" href="../Homepage/style.css">
    <link rel="stylesheet" href="../Patient_Dashboard/patient_dashboard.css">
</head>

<body>

    <!-- Alert Button -->
    <?php if (isset($_SESSION['patient_id'])): ?>
        <?php include "../alert_btn.php"; ?>
    <?php endif; ?>


    <!-- Navbar -->
    <?php include "../navbar.php" ?>


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

    <!-- Reports -->
    <div class="reports-container">

        <div class="reports-header">
            <h2>Medical Reports</h2>
            <a href="add_report.php" class="add-report-btn">+ Add Report</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Report Name</th>
                        <th>View</th>
                        <th>Download</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo date("d M Y", strtotime($row['upload_date'])); ?></td>
                                <td><?php echo $row['document_type']; ?></td>
                        
                                <!-- View -->
                                <td>
                                    <a href="<?php echo $row['file_url']; ?>" target="_blank">
                                        <button class="action-btn view-btn">View</button>
                                    </a>
                                </td>
                        
                                <!-- Download -->
                                <td>
                                    <a href="<?php echo $row['file_url']; ?>" download>
                                        <button class="action-btn download-btn">Download</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                            <tr>
                                <td colspan="4" style="text-align:center;">No reports uploaded</td>
                            </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Footer -->
    <?php include "../footer.php" ?>


</body>

</html>