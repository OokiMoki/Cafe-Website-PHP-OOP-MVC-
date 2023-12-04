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

    // Get values from the POST request
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $employee_id = isset($_POST['employee_id']) ? $_POST['employee_id'] : '';
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : '';
    $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : '';
    $end_date = isset($_POST['end_date']) ? $_POST['end_date'] : '';

    // Check if any required field is empty
    if (empty($id) || empty($employee_id) || empty($start_date) || empty($start_time) || empty($end_time) || empty($end_date)) {
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "All fields are required.!"
        ];
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Assuming $timeTableController is an instance of your TimeTableController class

        // Attempt to update the time entry
        if ($timeTableController->update($id, $employee_id, $start_date, $start_time, $end_time, $end_date)) {
            // Update successful, redirect to the referring page
            $_SESSION['message'] = [
                "type" => "success",
                "description" => "Time update successful.!"
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            // Update failed, likely due to existing or overlapping time entries
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "Time update failed. Time may already exist or overlap."
            ];
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }
}
?>
