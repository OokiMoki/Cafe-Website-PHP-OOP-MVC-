<?php
session_start();

unset($_SESSION['cart']);

session_destroy();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/confirm_cart/confirmation.css">
    <title>Pickup Confirmed</title>
</head>
<body style="background-color: #FF6B00;">
    <div class="confirmation-container" style="    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%); color:white; text-align:center;">
        <h1>Delivery Confirmed</h1>
        <p>Check your messages to receive your order details for delivery or pickup times!</p>
        <p>Redirecting you back in <span id="countdown">5</span> seconds.</p>
    </div>

    <script>
        let seconds = 5;
        function countdown() {
            document.getElementById('countdown').textContent = seconds;
            if (seconds <= 0) {
                window.location.href = '/home';
            } else {
                seconds--;
                setTimeout(countdown, 1000);
            }
        }
        countdown();
    </script>
</body>
</html>
