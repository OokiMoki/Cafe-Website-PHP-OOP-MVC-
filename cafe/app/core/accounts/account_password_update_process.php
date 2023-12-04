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

    // Get user ID, password, and confirm_password from the POST data
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    // Validate required fields
    if (empty($id) || empty($password) || empty($confirm_password)) {
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Password and Password Confirm fields are required!"
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Validate password confirmation
        if (!empty($password) && $password !== $confirm_password) {
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "The confirm password does not match. Try again."
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Attempt to update employee password using the UserController
        if ($userController->updateEmployeePassword($id, $password)) {
            // Password update successful, redirect to the previous page
            $_SESSION['message'] = [
                "type" => "success",
                "description" => "Password update successful!"
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Password update failed, display an error message or redirect to the previous page
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "Password update failed."
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>
