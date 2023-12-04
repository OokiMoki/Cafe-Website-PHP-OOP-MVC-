<?php
// Include necessary files
require_once 'Database.php';
require_once '../models/RegistrationModel.php';
require_once '../controllers/RegistrationController.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize Database, RegistrationModel, and RegistrationController
    $database = new \core\Database();
    $registrationModel = new \model\RegistrationModel($database);
    $registrationController = new \controller\RegistrationController($registrationModel);

    // Get user registration data from the POST data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Attempt to register the user using the RegistrationController
    if ($registrationController->registerUser($first_name, $last_name, $username, $password, $role)) {
        // Registration successful, redirect to login page or any other page
        header('Location: /login');
        exit();
    } else {
        // Registration failed, display an error message or redirect to the registration page
        echo "Registration failed. Username may already exist.";
    }
}
?>
