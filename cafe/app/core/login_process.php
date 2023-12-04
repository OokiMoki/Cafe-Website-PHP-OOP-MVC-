<?php
// Include necessary files
require_once 'Database.php';
require_once '../models/LoginModel.php';
require_once '../controllers/LoginController.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start a session
    session_start();

    // Initialize Database, LoginModel, and LoginController
    $database = new \core\Database();
    $loginModel = new \model\LoginModel($database);
    $loginController = new \controller\LoginController($loginModel);

    // Get username and password from the POST data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Attempt to login using the LoginController
    if ($loginController->login($username, $password)) {
        // Login successful, set session and redirect to the admin dashboard
        $_SESSION['username'] = $username;
        $_SESSION['message'] = [
            "type" => "success",
            "description" => "You are successfully logged in!"
        ];
        header('Location: /dashboard/admin_dashboard');
        exit();
    } else {
        // Login failed, display an error message or redirect to the login page
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Login failed. Incorrect username or password."
        ];
        header('Location: /login');
        exit();
    }
}
?>
