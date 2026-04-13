<?php
include '../connect.php';

if (!isset($_SESSION['patient_id'])) {
    header("Location: ../Login/patient_login.html");
    exit();
}

$patient_id = $_SESSION['patient_id'];

// Get profile
$res = $conn->query("SELECT * FROM health_profile WHERE patient_id='$patient_id'");
$profile = $res->fetch_assoc();
$profile_id = $profile['profile_id'] ?? null;

// Fetch child data
$allergies = [];
$conditions = [];
$medications = [];
$contacts = [];

if ($profile_id) {

    $r = $conn->query("SELECT e_phone FROM e_contact WHERE profile_id='$profile_id'");
    while ($row = $r->fetch_assoc()) $contacts[] = $row['e_phone'];

    $r = $conn->query("SELECT allergy FROM allergies WHERE profile_id='$profile_id'");
    while ($row = $r->fetch_assoc()) $allergies[] = $row['allergy'];

    $r = $conn->query("SELECT e_condition FROM existing_conditions WHERE profile_id='$profile_id'");
    while ($row = $r->fetch_assoc()) $conditions[] = $row['e_condition'];

    $r = $conn->query("SELECT medication FROM medications WHERE profile_id='$profile_id'");
    while ($row = $r->fetch_assoc()) $medications[] = $row['medication'];
}


// UPDATE LOGIC
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $blood_group = $_POST['blood_group'];
    $address = $_POST['address'];

    // Update main table
    $conn->query("UPDATE health_profile 
                  SET blood_group='$blood_group', address='$address' 
                  WHERE profile_id='$profile_id'");

    // Delete old child data
    $conn->query("DELETE FROM allergies WHERE profile_id='$profile_id'");
    $conn->query("DELETE FROM existing_conditions WHERE profile_id='$profile_id'");
    $conn->query("DELETE FROM medications WHERE profile_id='$profile_id'");
    $conn->query("DELETE FROM e_contact WHERE profile_id='$profile_id'");

    // Re-insert new data

    foreach ($_POST['contacts'] as $c) {
        if (!empty($c)) {
            $conn->query("INSERT INTO e_contact (profile_id, e_phone) VALUES ('$profile_id', '$c')");
        }
    }

    foreach ($_POST['allergies'] as $a) {
        if (!empty($a)) {
            $conn->query("INSERT INTO allergies (profile_id, allergy) VALUES ('$profile_id', '$a')");
        }
    }

    foreach ($_POST['conditions'] as $c) {
        if (!empty($c)) {
            $conn->query("INSERT INTO existing_conditions (profile_id, e_condition) VALUES ('$profile_id', '$c')");
        }
    }

    foreach ($_POST['medications'] as $m) {
        if (!empty($m)) {
            $conn->query("INSERT INTO medications (profile_id, medication) VALUES ('$profile_id', '$m')");
        }
    }

    header("Location: health_profile.php");
    exit();
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
        <h2>Edit Health Info</h2>
        <form method="POST" action="">
            <label for="">Blood Group</label>
            <select name="blood_group">
                <option disabled>Select</option>
                <?php
                    $groups = ["O-","O+","B-","B+","A-","A+","AB-","AB+"];
                    foreach ($groups as $g) {
                    $selected = ($profile['blood_group'] == $g) ? "selected" : "";
                    echo "<option value='$g' $selected>$g</option>";
                        }
                ?>
            </select>

            <label for="">Address</label>
            <input type="text" name="address" value="<?php echo $profile['address'] ?? ''; ?>">

            <div class="multi-input-container">
                <label for="">Emergency Contacts</label>
                <div class="e-contacts">
                    <?php foreach ($contacts as $c): ?>
                    <input type="text" name="contacts[]" value="<?php echo $c; ?>">
                    <?php endforeach; ?>
                    <input type="text" name="contacts[]">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <div class="multi-input-container">
                <label for="">Allergies</label>
                <div class="allergies">
                    <?php foreach ($allergies as $a): ?>
                    <input type="text" name="allergies[]" value="<?php echo $a; ?>">
                    <?php endforeach; ?>
                    <input type="text" name="allergies[]">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <div class="multi-input-container">
                <label for="">Diagnosed With</label>
                <div class="diagnosed">
                     <?php foreach ($conditions as $c): ?>
                    <input type="text" name="conditions[]" value="<?php echo $c; ?>">
                    <?php endforeach; ?>
                    <input type="text" name="conditions[]">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <div class="multi-input-container">
                <label for="">Medications</label>
                <div class="medication">
                    <?php foreach ($medications as $m): ?>
                    <input type="text" name="medications[]" value="<?php echo $m; ?>">
                    <?php endforeach; ?>
                    <input type="text" name="medications[]">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <input type="submit" value="UPDATE" class="submit-btn">

        </form>
    </div>



    <!-- Footer -->
   <?php include "../footer.php" ?>


   <!-- javascript -->
    <script>
        document.querySelectorAll(".h-add-btn").forEach(btn => {
        btn.addEventListener("click", function () {
            const container = this.previousElementSibling;
            const input = container.querySelector("input");
            const clone = input.cloneNode(true);
            clone.value = "";
            container.appendChild(clone);
            });
        });
    </script>
</body>

</html>