<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Health Profile</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="add_health_profile.css">
</head>

<body>
    <!-- Navbar -->
    <?php include "../navbar.php" ?>

    <!-- Form -->
    <div class="health-profile-form-container">
        <h2>Edit Health Info</h2>
        <form action="">
            <label for="">Blood Group</label>
            <select name="" id="">
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
            <input type="text" name="" id="">

            <div class="multi-input-container">
                <label for="">Emergency Contacts</label>
                <div class="e-contacts">
                    <input type="text" name="" id="">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <div class="multi-input-container">
                <label for="">Allergies</label>
                <div class="allergies">
                    <input type="text" name="" id="">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <div class="multi-input-container">
                <label for="">Diagnosed With</label>
                <div class="diagnosed">
                    <input type="text" name="" id="">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <div class="multi-input-container">
                <label for="">Medications</label>
                <div class="medication">
                    <input type="text" name="" id="">
                </div>
                <button type="button" class="h-add-btn">Add More +</button>
            </div>

            <input type="submit" value="SUBMIT" class="submit-btn">

        </form>
    </div>



    <!-- Footer -->
   <?php include "../footer.php" ?>
</body>

</html>