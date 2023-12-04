<?php
session_start();
include_once '../../../../config/app.php';
/** CHECK USERS USERNAME */
if (!isset($_SESSION['username'])) {
    header('Location: ../views/login/login.php');
    exit();
}
require_once __DIR__ . '../../../../controllers/AdminDashboardController.php';
require_once __DIR__ . '../../../../models/AdminDashboardModel.php';
require_once __DIR__ . '../../../../core/Database.php';

require_once __DIR__ . '../../../../controllers/TimeTableController.php';
require_once __DIR__ . '../../../../models/TimeTableModel.php';


// Example usage in breakfast.php
$adminDashboard = new controller\AdminDashboardController(new \model\AdminDashboardModel(new \core\Database()));
$timeTableController = new controller\TimeTableController(new \model\TimeTableModel(new \core\Database()));

$role = $adminDashboard->userRole();
if ($role == 'barista' || $role == 'waiter') {
    header('Location: ../../error/403.html');
    exit();
}
$timeTableData = $timeTableController->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../public/styles/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../../../public/jscripts/common/datatables.min.css">
    <link rel="stylesheet" href="../../../../public/styles/bootstrap/bootstrap.min.css">

    <script src="../../../../public/jscripts/jquery/jquery.min.js"></script>

    <title>Timatable</title>
</head>

<body>
    <?php include "../components/sidebar.php" ?>
    <!-- Main Page -->

    <div class="container ">
        <div class="mt-4">
            <div class="row">

                <div class="col-sm-12">
                    
                    <div class="row mb-3">

                        <div class="col-sm-12">
                            <h3><?php echo isset($_GET['employee_name']) ? htmlspecialchars($_GET['employee_name']) : '' ?></h3>
                            <div id='calendar'></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include "../../common.php" ?>
    <!-- Script for dashboard -->
    <script src="../../../../public/styles/bootstrap/bootstrap.min.js"></script>
    <script src="../../../../public/jscripts/common/common.js"></script>
    <script src="../../../../public/jscripts/common/index.global.min.js"></script>
    <?php
    if (isset($_GET['id'])) {
    ?>
        <script>
            var emp_id = "<?php echo $_GET['id'] ?>"
            document.addEventListener('DOMContentLoaded', function() {
                $.ajax({
                    url: '/app/core/timetable/get_events_all.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: emp_id
                    },
                    success: function(response) {
                        console.log(response)
                        if (response && response.length > 0) {
                            var calendarEl = document.getElementById('calendar');
                            var calendar = new FullCalendar.Calendar(calendarEl, {
                                height: '90vh',
                                initialView: 'timeGridWeek',
                                initialDate:response[0].start,
                                events: response,
                            });
                            calendar.render();
                        } else {
                            console.log('No events');
                        }
                    },
                    error: function(xhr, error) {
                        console.log(xhr);
                    }
                });

            });
        </script>
    <?php
    } else {
    ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                $.ajax({
                    url: '/app/core/timetable/get_events_all.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {},
                    success: function(response) {
                        if (response && response.length > 0) {
                            var calendarEl = document.getElementById('calendar');
                            var calendar = new FullCalendar.Calendar(calendarEl, {
                                height: '90vh',
                                initialView: 'timeGridWeek',
                                events: response,
                            });
                            calendar.render();
                        } else {
                            console.log('No events');
                        }
                    },
                    error: function() {
                        console.log('Error fetching events');
                    }
                });

            });
        </script>
    <?php } ?>
</body>

</html>