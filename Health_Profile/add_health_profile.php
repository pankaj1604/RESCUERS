<?php
include '../connect.php';

if (!isset($_SESSION['patient_id'])) {
    header("Location: ../Login/patient_login.html");
    exit();
}

$patient_id = $_SESSION['patient_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $blood_group = $_POST['blood_group'];
    $address = $_POST['address'];
    $whatsapp = $_POST['whatsapp'];

    // Insert into health_profile
    $sql = "INSERT INTO health_profile (patient_id, address, blood_group) 
            VALUES ('$patient_id', '$address', '$blood_group')";

    if ($conn->query($sql)) {

        $profile_id = $conn->insert_id;

        // Update whatsapp in patient table
        $conn->query("UPDATE patient SET whatsapp_num='$whatsapp' WHERE patient_id='$patient_id'");

        // Insert allergies
        if (!empty($_POST['allergies'])) {
            foreach ($_POST['allergies'] as $a) {
                if (!empty($a)) {
                    $conn->query("INSERT INTO allergies (profile_id, allergy) VALUES ('$profile_id', '$a')");
                }
            }
        }

        // Insert conditions
        if (!empty($_POST['conditions'])) {
            foreach ($_POST['conditions'] as $c) {
                if (!empty($c)) {
                    $conn->query("INSERT INTO existing_conditions (profile_id, e_condition) VALUES ('$profile_id', '$c')");
                }
            }
        }

        // Insert medications
        if (!empty($_POST['medications'])) {
            foreach ($_POST['medications'] as $m) {
                if (!empty($m)) {
                    $conn->query("INSERT INTO medications (profile_id, medication) VALUES ('$profile_id', '$m')");
                }
            }
        }

        // Insert emergency contacts
        if (!empty($_POST['contacts'])) {
            foreach ($_POST['contacts'] as $p) {
                if (!empty($p)) {
                    $conn->query("INSERT INTO e_contact (profile_id, e_phone) VALUES ('$profile_id', '$p')");
                }
            }
        }

        header("Location: health_profile.php");
        exit();

    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Health Profile</title>
    <link rel="stylesheet" href="../Homepage/style.css">
    <link rel="stylesheet" href="add_health_profile.css">
</head>

<body>
    <!-- Navbar -->
    <?php include "../navbar.php" ?>


    <!-- Form -->
    <div class="health-profile-form-container">
        <h2>Add Health Info</h2>
        <form method="POST" action="">
            <label for="">Blood Group</label>
            <select name="blood_group">
                <option value="" disabled selected hidden>Select</option>
                <option value="O-">O-</option>
                <option value="O+">O+</option>
                <option value="B-">B-</option>
                <option value="B+">B+</option>
                <option value="A-">A-</option>
                <option value="A+">A+</option>
                <option value="AB-">AB-</option>
                <option value="AB+">AB+</option>
            </select>

            <label for="">Address</label>
            <input type="text" name="address">

            <label for="">Whatsapp Number</label>
            <input type="text" name="whatsapp">

            <div class="multi-input-container">
                <label for="">Emergency Contacts</label>
                <div class="e-contacts">
                    <input type="text" name="contacts[]">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <div class="multi-input-container">
                <label for="">Allergies</label>
                <div class="allergies">
                    <input type="text" name="allergies[]">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <div class="multi-input-container">
                <label for="">Diagnosed With</label>
                <div class="diagnosed">
                    <input type="text" name="conditions[]">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <div class="multi-input-container">
                <label for="">Medications</label>
                <div class="medication">
                    <input type="text" name="medications[]">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <input type="submit" value="SUBMIT" class="submit-btn">

        </form>
    </div>



    <!-- Footer -->
    <?php include "../footer.php" ?>

    <!-- javascript -->
    <script>
        document.querySelectorAll(".h-add-btn").forEach((btn) => {
        btn.addEventListener("click", function () {

                const container = this.previousElementSibling;
                const input = container.querySelector("input");
                const newInput = input.cloneNode(true);

                newInput.value = "";
                container.appendChild(newInput);
            });
        });
    </script>
</body>

</html>