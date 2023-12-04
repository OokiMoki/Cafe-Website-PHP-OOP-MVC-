<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/login/login.css">
    <link rel="stylesheet" href="../../../public/styles/bootstrap/bootstrap.min.css">
    <script src="../../../public/jscripts/jquery/jquery.min.js"></script>
    <title>Menu Page</title>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Dino's Login</div>
        <ul class="menu">
            <li><a href="/home">Home</a></li>
        </ul>
    </nav>

    <div class="login-container">
    <h2>Login</h2>
    <form action="../../../app/core/login_process.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
    </div>
    <?php include "../common.php" ?>

    <script src="../../../public/styles/bootstrap/bootstrap.min.js"></script>
    <script src="../../../public/jscripts/common/common.js"></script>
</body>
</html>