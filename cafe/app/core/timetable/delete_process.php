<?php
// Include necessary files
require_once '../Database.php';
require_once '../../models/TimeTableModel.php';
require_once '../../controllers/TimeTableController.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start a session
    session_start();

    // Initialize Database, Model, and Controller for TimeTable
    $database = new \core\Database();
    $timeTableModel = new \model\TimeTableModel($database);
    $timeTableController = new \controller\TimeTableController($timeTableModel);

    // Get the ID from the POST request
    $id = isset($_POST['id']) ? $_POST['id'] : '';

    // Validate if the ID is not empty
    if (empty($id)) {
        // Set an error message if the ID field is empty
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "ID field is required!"
        ];
        // Redirect to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Process time deletion
        if ($timeTableController->delete($id)) {
            // Time deletion successful, set success message
            $_SESSION['message'] = [
                "type" => "success",
                "description" => "Time deleted successful!"
            ];
            // Redirect to the previous page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Time deletion failed, set error message
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "Time deletion failed."
            ];
            // Redirect to the previous page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>
