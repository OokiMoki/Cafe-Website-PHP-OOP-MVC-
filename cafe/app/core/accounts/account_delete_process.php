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

    // Get user ID from the POST data
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    // Validate required ID field
    if (empty($id)) {
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "ID field is required!"
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Attempt to delete an employee using the UserController
        if ($userController->deleteEmployee($id)) {
            // Deletion successful, redirect to the previous page
            $_SESSION['message'] = [
                "type" => "success",
                "description" => "Account deleted successfully!"
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Deletion failed, display an error message or redirect to the previous page
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "Account deletion failed."
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>
