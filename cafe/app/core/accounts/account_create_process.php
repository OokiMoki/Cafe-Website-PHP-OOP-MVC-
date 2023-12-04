<?php
// Include necessary files
require_once '../Database.php';
require_once '../../models/UserModel.php';
require_once '../../controllers/UserController.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start a session
    session_start();

    // Initialize Database, UserModel, and UserController
    $database = new \core\Database();
    $userModel = new \models\UserModel($database);
    $userController = new \controller\UserController($userModel);

    // Get user registration data from the POST data
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Validate required fields
    if (empty($first_name) || empty($last_name) || empty($username) || empty($password) || empty($role)) {
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "All fields are required!"
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Validate password confirmation
        if ($password !== $confirm_password) {
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "The confirm password does not match. Try again."
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Attempt to create a new employee using the UserController
        if ($userController->createEmployee($first_name, $last_name, $username, $password, $role)) {
            // Registration successful, redirect to login page or any other page
            $_SESSION['message'] = [
                "type" => "success",
                "description" => "Account creation successful!"
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Registration failed, display an error message or redirect to the registration page
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "Account creation failed. Username may already exist."
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>
