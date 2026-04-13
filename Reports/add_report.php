<?php
require_once '../connect.php';

if (!isset($_SESSION['patient_id'])) {
    header("Location: ../Login/patient_login.html");
    exit();
}

$patient_id = $_SESSION['patient_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $report_name = $_POST['report_name'];

    if (isset($_FILES['report_file']) && $_FILES['report_file']['error'] === 0) {

        $file = $_FILES['report_file'];

        $file_name = time() . "_" . basename($file['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $file_name;

        $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        $allowed = ['pdf', 'jpg', 'jpeg', 'png'];

        if (in_array($file_type, $allowed)) {

            if (move_uploaded_file($file['tmp_name'], $target_file)) {

                
                $file_path = "uploads/" . $file_name;

                $sql = "INSERT INTO report (patient_id, document_type, file_url) 
                        VALUES ('$patient_id', '$report_name', '$file_path')";

                if ($conn->query($sql)) {
                    header("Location: reports.php"); 
                    exit();
                } else {
                    echo "DB Error: " . $conn->error;
                }

            } else {
                echo "File upload failed!";
            }

        } else {
            echo "Only PDF, JPG, JPEG, PNG allowed!";
        }

    } else {
        echo "Please select a file!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Report</title>
    <link rel="stylesheet" href="add_report.css">
    <link rel="stylesheet" href="../Homepage/style.css">
</head>

<body>

    <!-- Navbar -->
    <?php include "../navbar.php" ?>

    <div class="add-report-container">

        <h2>Add Medical Report</h2>

        <form method="POST" action="" enctype="multipart/form-data">

            <!-- Report Name -->
            <label>Report Name</label>
            <input type="text" name="report_name" placeholder="Enter report name" required>

            <!-- File Upload -->
            <label>Upload Report</label>

            <div class="drop-area" id="drop-area">
                <p>Drag & Drop file here</p>
                <span>or</span>
                <input type="file" id="fileInput" name="report_file" hidden required>
                <button type="button" class="browse-btn">Browse File</button>
                <p class="file-name" id="fileName">No file selected</p>
            </div>

            <!-- Submit -->
            <button type="submit" class="submit-btn">Upload Report</button>

        </form>

    </div>

    <!-- Footer -->
    <?php include "../footer.php" ?>


    <!-- Javascript -->
    <script>
        const dropArea = document.getElementById("drop-area");
        const fileInput = document.getElementById("fileInput");
        const fileName = document.getElementById("fileName");
        const browseBtn = document.querySelector(".browse-btn");

        browseBtn.addEventListener("click", () => fileInput.click());

        fileInput.addEventListener("change", () => {
            fileName.textContent = fileInput.files[0]?.name || "No file selected";
        });

        dropArea.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropArea.classList.add("dragover");
        });

        dropArea.addEventListener("dragleave", () => {
            dropArea.classList.remove("dragover");
        });

        dropArea.addEventListener("drop", (e) => {
            e.preventDefault();
            dropArea.classList.remove("dragover");

            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileName.textContent = files[0].name;
            }
        });
    </script>

</body>

</html>