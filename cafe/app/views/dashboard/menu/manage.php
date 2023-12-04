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

require_once __DIR__ . '../../../../controllers/BreakfastController.php';
require_once __DIR__ . '../../../../models/BreakfastModel.php';

require_once __DIR__ . '../../../../controllers/LunchController.php';
require_once __DIR__ . '../../../../models/LunchModel.php';

require_once __DIR__ . '../../../../controllers/DinnerController.php';
require_once __DIR__ . '../../../../models/DinnerModel.php';

require_once __DIR__ . '../../../../controllers/DrinksController.php';
require_once __DIR__ . '../../../../models/DrinksModel.php';

// Example usage in breakfast.php
$adminDashboard = new controller\AdminDashboardController(new \model\AdminDashboardModel(new \core\Database()));
$breakFastController = new controller\BreakfastController(new \model\BreakfastModel(new \core\Database()));
$lunchController = new controller\LunchController(new \model\LunchModel(new \core\Database()));
$dinnerController = new controller\DinnerController(new \model\DinnerModel(new \core\Database()));
$drinksController = new controller\DrinksController(new \model\DrinksModel(new \core\Database()));

$role = $adminDashboard->userRole();
if ($role == 'barista' || $role == 'waiter') {
    header('Location: ../../error/403.html');
    exit();
}
$breakFastdata = $breakFastController->getBreakfastMenu();
$lunchData = $lunchController->getLunchMenu();
$dinnerData = $dinnerController->getDinnerMenu();
$drinksData = $drinksController->getDrinksMenu();
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

    <title>Menu | Manage</title>
</head>

<body>
    <?php include "../components/sidebar.php" ?>
    <!-- Main Page -->

    <div class="container mt-5">
        <div class="bg-primary p-2 rounded-2 text-white">
            <h4 class="mb-0"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill mb-1" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="8" />
                </svg>
                Manage Menu
            </h4>
            <span class="small ms-4">Menu > manage</span>
        </div>

        <div class="mt-4">
            <div class="row">

                <div class="col-sm-12">
                    <div class="text-end mb-3">
                        <a href="./create.php" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg me-2 mb-1" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                            </svg>
                            Create New Menu
                        </a>
                    </div>

                    <ul class="nav nav-tabs d-none d-lg-flex" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="breakfast-tab" data-bs-toggle="tab" data-bs-target="#breakfast-tab-pane" type="button" role="tab" aria-controls="breakfast-tab-pane" aria-selected="true">Breakfast</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="lunch-tab" data-bs-toggle="tab" data-bs-target="#lunch-tab-pane" type="button" role="tab" aria-controls="lunch-tab-pane" aria-selected="false">Lunch</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="dinner-tab" data-bs-toggle="tab" data-bs-target="#dinner-tab-pane" type="button" role="tab" aria-controls="dinner-tab-pane" aria-selected="false">Dinner</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="drinks-tab" data-bs-toggle="tab" data-bs-target="#drinks-tab-pane" type="button" role="tab" aria-controls="drinks-tab-pane" aria-selected="false">Drinks</button>
                        </li>
                    </ul>
                    <div class="tab-content accordion mt-4" id="myTabContent">
                        <div class="tab-pane fade show active accordion-item" id="breakfast-tab-pane" role="tabpanel" aria-labelledby="breakfast-tab" tabindex="0">

                            <h2 class="accordion-header d-lg-none" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Accordion Item #1</button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show  d-lg-block" aria-labelledby="headingOne" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <table class="table table-responsive table-striped" id="datatable1">
                                        <thead >
                                            <tr>
                                                <th class="text-center">#Item ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Iterate over the results and create table rows
                                            foreach ($breakFastdata as $d) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo htmlspecialchars($d['item_id']); ?></td>
                                                    <td><?php echo htmlspecialchars($d['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($d['price']); ?></td>
                                                    <td>
                                                        <img src="../../../../public/assets/breakfast/<?php echo htmlspecialchars($d['image']); ?>" alt="" width="80px" height="50px">
                                                    </td>
                                                    <td class="text-center">

                                                        <a href="./view.php?item_id=<?php echo htmlspecialchars($d['item_id']); ?>&menu=breakfast_menu" class="btn btn-info btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                            </svg>
                                                            View
                                                        </a>
                                                        <a href="./edit.php?item_id=<?php echo htmlspecialchars($d['item_id']); ?>&menu=breakfast_menu" class="btn btn-primary btn-sm">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                            </svg>
                                                            Edit
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm delete" data-url="/app/core/menu/delete_process.php?menu=breakfast_menu" data-id="<?php echo $d['item_id'] ?>">
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
                        <div class="tab-pane fade accordion-item" id="lunch-tab-pane" role="tabpanel" aria-labelledby="lunch-tab" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Lunch
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse d-lg-block" aria-labelledby="headingTwo" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <table class="table table-responsive table-striped" id="datatable2">
                                        <thead >
                                            <tr>
                                                <th class="text-center">#Item ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Iterate over the results and create table rows
                                            foreach ($lunchData as $d) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo htmlspecialchars($d['item_id']); ?></td>
                                                    <td><?php echo htmlspecialchars($d['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($d['price']); ?></td>
                                                    <td>
                                                        <img src="../../../../public/assets/lunch/<?php echo htmlspecialchars($d['image']); ?>" alt="" width="80px" height="50px">
                                                    </td>
                                                    <td class="text-center">

                                                        <a href="./view.php?item_id=<?php echo htmlspecialchars($d['item_id']); ?>&menu=lunch_menu" class="btn btn-info btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                            </svg>
                                                            View
                                                        </a>
                                                        <a href="./edit.php?item_id=<?php echo htmlspecialchars($d['item_id']); ?>&menu=lunch_menu" class="btn btn-primary btn-sm">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                            </svg>
                                                            Edit
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm delete" data-url="/app/core/menu/delete_process.php?menu=lunch_menu" data-id="<?php echo $d['item_id'] ?>">
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
                        <div class="tab-pane fade accordion-item" id="dinner-tab-pane" role="tabpanel" aria-labelledby="dinner-tab" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Dinner
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse d-lg-block" aria-labelledby="headingThree" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <table class="table table-responsive table-striped" id="datatable3">
                                        <thead >
                                            <tr>
                                                <th class="text-center">#Item ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Iterate over the results and create table rows
                                            foreach ($dinnerData as $d) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo htmlspecialchars($d['item_id']); ?></td>
                                                    <td><?php echo htmlspecialchars($d['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($d['price']); ?></td>
                                                    <td>
                                                        <img src="../../../../public/assets/dinner/<?php echo htmlspecialchars($d['image']); ?>" alt="" width="80px" height="50px">
                                                    </td>
                                                    <td class="text-center">

                                                        <a href="./view.php?item_id=<?php echo htmlspecialchars($d['item_id']); ?>&menu=dinner_menu" class="btn btn-info btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                            </svg>
                                                            View
                                                        </a>
                                                        <a href="./edit.php?item_id=<?php echo htmlspecialchars($d['item_id']); ?>&menu=dinner_menu" class="btn btn-primary btn-sm">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                            </svg>
                                                            Edit
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm delete" data-url="/app/core/menu/delete_process.php?menu=dinner_menu" data-id="<?php echo $d['item_id'] ?>">
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
                        <div class="tab-pane fade accordion-item" id="drinks-tab-pane" role="tabpanel" aria-labelledby="drinks-tab" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Drinks
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse d-lg-block" aria-labelledby="headingThree" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                <table class="table table-responsive table-striped" id="datatable4">
                                        <thead >
                                            <tr>
                                                <th class="text-center">#Item ID</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Iterate over the results and create table rows
                                            foreach ($drinksData as $d) {
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo htmlspecialchars($d['item_id']); ?></td>
                                                    <td><?php echo htmlspecialchars($d['name']); ?></td>
                                                    <td><?php echo htmlspecialchars($d['price']); ?></td>
                                                    <td>
                                                        <img src="../../../../public/assets/drinks/<?php echo htmlspecialchars($d['image']); ?>" alt="" width="80px" height="50px">
                                                    </td>
                                                    <td class="text-center">

                                                        <a href="./view.php?item_id=<?php echo htmlspecialchars($d['item_id']); ?>&menu=drinks_menu" class="btn btn-info btn-sm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                            </svg>
                                                            View
                                                        </a>
                                                        <a href="./edit.php?item_id=<?php echo htmlspecialchars($d['item_id']); ?>&menu=drinks_menu" class="btn btn-primary btn-sm">

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                                                            </svg>
                                                            Edit
                                                        </a>
                                                        <button type="button" class="btn btn-danger btn-sm delete" data-url="/app/core/menu/delete_process.php?menu=drinks_menu" data-id="<?php echo $d['item_id'] ?>">
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
        new DataTable('#datatable1');
        new DataTable('#datatable2');
        new DataTable('#datatable3');
        new DataTable('#datatable4');
    </script>
</body>

</html>