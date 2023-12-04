<?php
session_start();
include_once '../../../config/app.php';
/** CHECK USERS USERNAME */
if (!isset($_SESSION['username'])) {
    header('Location: ../views/login/login.php');
    exit();
}
require_once __DIR__ . '../../../controllers/AdminDashboardController.php';
require_once __DIR__ . '../../../models/AdminDashboardModel.php';
require_once __DIR__ . '../../../core/Database.php';
// Example usage in breakfast.php
$adminDashboard = new controller\AdminDashboardController(new \model\AdminDashboardModel(new \core\Database()));
$role = $adminDashboard->userRole();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../../public/styles/bootstrap/bootstrap.min.css">
    <script src="../../../public/jscripts/jquery/jquery.min.js"></script>
    <title>Dino's Dashboard</title>
</head>

<body>
    <?php include "./components/sidebar.php" ?>
    <!-- Main Page -->

    <div class="container">
        <div class="welcome">
            <h1>Welcome to Dino's Dashboard</h1>
        </div>

        <div class="main-content-container">
            <div class="loading-overlay">
                Loading...
            </div>
            <h3>Latest Blog Posts</h3>
            <div class="blog-post">
                <h4>Exploring New Culinary Trends</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#">Read more</a>
            </div>

            <div class="blog-post">
                <h4>10 Tips for a Perfect Dining Experience</h4>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <a href="#">Read more</a>
            </div>

            <h3>Latest News</h3>
            <div class="news-item">
                <h4>New Chef Joins Our Team</h4>
                <p>Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <a href="#">Read more</a>
            </div>

            <div class="news-item">
                <h4>Extended Opening Hours</h4>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                <a href="#">Read more</a>
            </div>
        </div>
    </div>
    </div>

    <!-- Timetable Page -->
    <div class="timetable-content">
        <div class="welcome">
            <!-- Additional content specific to the timetable page -->
        </div>

        <div class="main-content-container">
            <div class="loading-overlay">
                Loading...
            </div>

            <div id="content-timetable">
                <!-- Timetable content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Accounts Page -->
    <div class="account-content">
        <div class="welcome">
            <!-- Additional content specific to the accounts page -->
        </div>

        <div class="account-content-container">
            <div class="loading-overlay">
                Loading...
            </div>

            <div id="content-account">
                <!-- Accounts content will be loaded here -->
            </div>
        </div>
    </div>

    <!-- Menu Page -->
    <div class="menu-content">
        <div class="welcome">
            <!-- Additional content specific to the menu page -->
        </div>

        <div class="content-container">
            <div class="loading-overlay">
                Loading...
            </div>

            <div id="content-menu">
                <!-- Menu content will be loaded here -->
            </div>
        </div>
    </div>
    <?php include "../common.php" ?>
    <!-- Script for dashboard -->
    <script src="../../../public/jscripts/dashboard/dashboard.js"></script>
    <script src="../../../public/styles/bootstrap/bootstrap.min.js"></script>
    <script src="../../../public/jscripts/common/common.js"></script>
</body>

</html>