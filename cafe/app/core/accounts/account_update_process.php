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

    // Get user ID, first_name, last_name, username, and role from the POST data
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';

    // Validate required fields
    if (empty($id) || empty($first_name) || empty($last_name) || empty($username) || empty($role)) {
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "All fields are required!"
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Attempt to update employee information using the UserController
        if ($userController->updateEmployee($id, $first_name, $last_name, $username, $role)) {
            // Update successful, redirect to the previous page
            $_SESSION['message'] = [
                "type" => "success",
                "description" => "Account update successful!"
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Update failed, display an error message or redirect to the previous page
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "Account update failed. Username may already exist."
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>
