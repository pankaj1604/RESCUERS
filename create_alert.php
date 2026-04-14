<?php
include 'connect.php';

// Check login
if (!isset($_SESSION['patient_id'])) {
    echo "Unauthorized";
    exit();
}

// Get JSON input
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['latitude']) || !isset($data['longitude'])) {
    echo "Invalid data";
    exit();
}

$patient_id = $_SESSION['patient_id'];
$lat = $data['latitude'];
$lng = $data['longitude'];

/* ================= INSERT ALERT ================= */

$sql = "INSERT INTO emergency_alert 
(patient_id, latitude, longitude, status, ambulance_called) 
VALUES 
('$patient_id', '$lat', '$lng', 'active', 'no')";

if (!$conn->query($sql)) {
    echo "Error creating alert: " . $conn->error;
    exit();
}

$alert_id = $conn->insert_id;

/* ================= FIND NEAREST VOLUNTEERS ================= */

/*
Distance Formula (Haversine)
6371 = Earth's radius in KM
*/

$radius_km = 10; // Change as needed

$vol_sql = "
SELECT volunteer_id,
(
    6371 * acos(
        cos(radians($lat)) * 
        cos(radians(latitude)) * 
        cos(radians(longitude) - radians($lng)) + 
        sin(radians($lat)) * 
        sin(radians(latitude))
    )
) AS distance
FROM volunteer
WHERE latitude IS NOT NULL AND longitude IS NOT NULL
HAVING distance < $radius_km
ORDER BY distance ASC
LIMIT 10
";

$result = $conn->query($vol_sql);

if (!$result) {
    echo "Error finding volunteers: " . $conn->error;
    exit();
}

/* ================= INSERT INTO alert_volunteer ================= */

$count = 0;

while ($row = $result->fetch_assoc()) {

    $volunteer_id = $row['volunteer_id'];

    // Prevent duplicate entry (optional safety)
    $check = $conn->query("
        SELECT * FROM alert_volunteer 
        WHERE alert_id='$alert_id' AND volunteer_id='$volunteer_id'
    ");

    if ($check->num_rows == 0) {

        $insert = "
        INSERT INTO alert_volunteer 
        (alert_id, volunteer_id, notified_time, response_status)
        VALUES 
        ('$alert_id', '$volunteer_id', NOW(), 'pending')
        ";

        if ($conn->query($insert)) {
            $count++;
        }
    }
}

/* ================= RESPONSE ================= */

if ($count > 0) {
    echo "Alert sent to $count nearby volunteers!";
} else {
    echo "No nearby volunteers found.";
}
?>