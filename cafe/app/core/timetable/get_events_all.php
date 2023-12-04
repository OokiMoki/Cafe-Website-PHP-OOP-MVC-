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

    // Check if ID is provided
    if (!empty($id)) {
        // Fetch a specific time entry by ID
        $events = array();
        $data = $timeTableController->getById($id);
        
        // Prepare event data for JSON response
        $events[] = array(
            'title' => $data['first_name'] . ' ' . $data['last_name'],
            'start' => $data['start_date'] . ' ' . $data['start_time'],
            'end' => $data['end_date'] . ' ' . $data['end_time']
        );
        
        // Encode events data to JSON and echo
        echo json_encode($events);
    } else {
        // Fetch all time entries
        $entries = $timeTableController->getAll();

        // Prepare events data for JSON response
        $events = array();
        foreach ($entries as $entry) {
            $events[] = array(
                'title' => $entry['first_name'] . ' ' . $entry['last_name'],
                'start' => $entry['start_date'] . ' ' . $entry['start_time'],
                'end' => $entry['end_date'] . ' ' . $entry['end_time']
            );
        }
        
        // Encode events data to JSON and echo
        echo json_encode($events);
    }
}
?>
