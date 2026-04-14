<?php include "../connect.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
</head>

<body>
    <!-- Navbar -->
    <nav>
        <a href="../Homepage/index.php" class="logo">
            <img src="../images/logo.png" alt="rescuers_logo">
            <h2>RESCUERS</h2>
        </a>

        <div class="navbar">
            <div class="navlinks">
                <a href="../Homepage/index.php">HOME</a>
                <a href="#">ABOUT</a>
                <a href="#">FEATURES</a>
                <a href="#">CONTACT</a>
            </div>
            <div class="search">
                <img src="../icons/navbar_icons/search_icon.svg" alt="search">
            </div>
            <div class="account">
                <img src="../icons/navbar_icons/account.svg" alt="">
            
                <div class="user-icon-opt" id="user-icon-opt">
            
                    <?php if (isset($_SESSION['patient_id'])): ?>
                    
                        <a href="../Patient_Dashboard/patient_dashboard.php">Dashboard</a>
                        <a href="../logout.php">Logout</a>
                    
                    <?php elseif (isset($_SESSION['volunteer_id'])): ?>
                    
                        <a href="../Volunteer_Dashboard/volunteer_dashboard.php">Dashboard</a>
                        <a href="../logout.php">Logout</a>
                    
                    <?php else: ?>
                    
                        <a href="../Login/patient_login.php">Patient Login</a>
                        <a href="../Login/volunteer_login.php">Volunteer Login</a>
                    
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </nav>

    <script src="Homepage/index.js"></script>
</body>

</html>