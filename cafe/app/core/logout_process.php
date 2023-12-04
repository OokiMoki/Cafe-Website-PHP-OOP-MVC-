<?php
// Start a session
session_start();

// Include necessary files
require_once '../models/LogoutModel.php';
require_once '../controllers/LogoutController.php';

// Initialize LogoutModel and LogoutController
$logoutModel = new \model\LogoutModel();
$logoutController = new \controller\LogoutController($logoutModel);

// Perform the logout process using the LogoutController
$logoutController->performLogout();

// Redirect to the login page after logout
header('Location: /login');
exit();
?>
