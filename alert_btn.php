<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alert Button</title>
    <link rel="stylesheet" href="../Homepage/style.css">
</head>

<style>
    /* Alert Button */
    .hover-alert-btn {
        padding: 12px 20px;
        background: #C42026;
        box-shadow: 0px 0px 15px rgba(0,0,0,0.3);
        width: max-content;
        border-radius: 4px;
        color: #fff;
        font-weight: 500;
        font-size: 16px;
        margin-top: 64px;
        border: none;
        outline: none;
        cursor: pointer;

        position: fixed;
        bottom: 64px;
        right: 64px;

        z-index: 99;
    }

    .hover-alert-btn>img {
        display: inline-block;
        width: 25px;
        margin-right: 6px;
    }
</style>

<body>
    <button class="hover-alert-btn hover-up" onclick="sendAlert()"><img src="../icons/alert-icon.png" alt=""> ALERT</button>

    <script>
        function sendAlert() {
            navigator.geolocation.getCurrentPosition((position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                fetch('create_alert.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ latitude: lat, longitude: lng })
                })
                .then(res => res.text())
                .then(data => alert(data));
            });
        }
    </script>
</body>

</html>