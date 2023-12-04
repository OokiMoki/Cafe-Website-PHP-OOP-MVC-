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

    // Get data from the POST request
    $employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : '';
    $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : '';
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

    // Validate required fields
    if (empty($employee_id) || empty($start_date) || empty($start_time) || empty($end_time) || empty($end_date)) {
        // Set an error message if any required field is empty
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "All fields are required!"
        ];
        // Redirect to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Process time creation
        if ($timeTableController->create($employee_id, $start_date, $start_time, $end_time, $end_date)) {
            // Time creation successful, set success message
            $_SESSION['message'] = [
                "type" => "success",
                "description" => "Time creation successful!"
            ];
            // Redirect to the previous page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Time creation failed, set error message
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "Time creation failed. Time may already exist or overlapping."
            ];
            // Redirect to the previous page
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>
