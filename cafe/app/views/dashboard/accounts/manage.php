<?php
session_start();
include_once '../../../../config/app.php';
/** CHECK USERS USERNAME */
if (!isset($_SESSION['username'])) {
    header('Location: ../views/login/login.php');
    exit();
}
require_once __DIR__ . '../../../../controllers/AdminDashboardController.php';
require_once __DIR__ . '../../../../controllers/UserController.php';
require_once __DIR__ . '../../../../models/AdminDashboardModel.php';
require_once __DIR__ . '../../../../models/UserModel.php';
require_once __DIR__ . '../../../../core/Database.php';
// Example usage in breakfast.php
$adminDashboard = new controller\AdminDashboardController(new \model\AdminDashboardModel(new \core\Database()));
$userController = new controller\UserController(new \models\UserModel(new \core\Database()));
$role = $adminDashboard->userRole();
if ($role == 'barista' || $role == 'waiter') {
    header('Location: ../../error/403.html');
    exit();
}
$data = $userController->getEmployees();
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

    <title>Accounts | Manage</title>
</head>

<body>
    <?php include "../components/sidebar.php" ?>
    <!-- Main Page -->

    <div class="container mt-5">
        <div class="bg-primary p-2 rounded-2 text-white">
            <h4 class="mb-0"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill mb-1" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="8" />
                </svg>
                Manage Accounts
            </h4>
            <span class="small ms-4">Accounts > manage</span>
        </div>

        <div class="mt-4">
            <div class="row">

                <div class="col-sm-12">
                    <div class="text-end mb-3">
                        <a href="./create.php" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-2 mb-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                            </svg>
                            Create New Account
                        </a>
                    </div>
                    <table class="table table-responsive table-striped" id="datatable">
                        <thead>
                            <tr>
                                <th class="text-center">#Employee Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th class="text-center">Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Iterate over the results and create table rows
                            foreach ($data as $d) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo htmlspecialchars($d['employee_id']); ?></td>
                                    <td><?php echo htmlspecialchars($d['first_name']); ?></td>
                                    <td><?php echo htmlspecialchars($d['last_name']); ?></td>
                                    <td><?php echo htmlspecialchars($d['username']); ?></td>
                                    <td class="text-center">

                                        <?php
                                        if (htmlspecialchars($d['role']) == 'manager') {
                                            echo "<span class='badge bg-success p-2 rounded-5'>Manager</span>";
                                        } elseif (htmlspecialchars($d['role']) == 'chef') {
                                            echo "<span class='badge bg-primary p-2 rounded-5'>Chef</span>";
                                        } elseif (htmlspecialchars($d['role']) == 'barista') {
                                            echo "<span class='badge bg-warning p-2 rounded-5'>Barista</span>";
                                        } elseif (htmlspecialchars($d['role']) == 'waiter') {
                                            echo "<span class='badge bg-dark p-2 rounded-5'>Waiter</span>";
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">

                                        <a href="./view.php?employee_id=<?php echo htmlspecialchars($d['employee_id']); ?>" class="btn btn-info btn-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                            </svg>
                                            View
                                        </a>
                                        <a href="./edit.php?employee_id=<?php echo htmlspecialchars($d['employee_id']); ?>" class="btn btn-primary btn-sm">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                            </svg>
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete" data-url="/app/core/accounts/account_delete_process.php" data-id="<?php echo $d['employee_id'] ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                            </svg>
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include "../../common.php" ?>
    <!-- Script for dashboard -->
    <script src="../../../../public/styles/bootstrap/bootstrap.min.js"></script>
    <script src="../../../../public/jscripts/common/common.js"></script>
    <script src="../../../../public/jscripts/common/datatables.min.js"></script>
    <script>
        new DataTable('#datatable');
    </script>
</body>

</html>