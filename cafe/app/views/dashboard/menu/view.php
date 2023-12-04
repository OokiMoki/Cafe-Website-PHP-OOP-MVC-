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
$id = isset($_GET['item_id']) && $_GET['item_id'] != "" ? $_GET['item_id'] : header("Location: ./manage.php");
$menu = isset($_GET['menu']) && $_GET['menu'] != "" ? $_GET['menu'] : header("Location: ./manage.php");

if($menu == 'breakfast_menu'){
    $data = $breakFastController->getMenuById($id);
    $path = '../../../../public/assets/breakfast/';
    $menu = "Breakfast Menu";
}elseif($menu == 'lunch_menu'){
    $data = $lunchController->getMenuById($id);
    $path = '../../../../public/assets/lunch/';
    $menu = "Lunch Menu";
}elseif($menu == 'dinner_menu'){
    $data = $dinnerController->getMenuById($id);
    $path = '../../../../public/assets/dinner/';
    $menu = "Dinner Menu";
}elseif($menu == 'drinks_menu'){
    $data = $drinksController->getMenuById($id);
    $path = '../../../../public/assets/drinks/';
    $menu = "Drinks Menu";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../public/styles/dashboard/dashboard.css">
    <link rel="stylesheet" href="../../../../public/styles/bootstrap/bootstrap.min.css">
    <script src="../../../../public/jscripts/jquery/jquery.min.js"></script>
    <title>Menu | View</title>
</head>

<body>
    <?php include "../components/sidebar.php" ?>
    <!-- Main Page -->

    <div class="container mt-5">
        <div class="bg-primary p-2 rounded-2 text-white">
            <h4 class="mb-0"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill mb-1" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="8" />
                </svg>
                View Menu
            </h4>
            <span class="small ms-4">Menu > view</span>
        </div>

        <div class="mt-4">

            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="text-end mb-3">
                        <a href="./manage.php" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                            </svg>
                            Back
                        </a>
                        <a href="./edit.php?item_id=<?php echo htmlspecialchars($data['item_id']); ?>&menu=breakfast_menu" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                            </svg>
                            Edit Menu
                        </a>
                    </div>
                    <div class="bg-light p-3">
                    <div class="mb-3">
                            <label for="first_name" class="form-label text-muted" >Menu : </label>
                            <br>
                            <strong><?php echo $menu ?></strong>
                        </div>
                        <!-- First Name -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label text-muted">Name : </label>
                            <br>
                            <strong><?php echo htmlspecialchars($data["name"]) ?></strong>
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label for="first_name" class="form-label text-muted">Price : </label>
                            <br>
                            <strong><?php echo htmlspecialchars($data["price"]) ?></strong>
                        </div>

                        <div class="mb-3">
                            <label for="first_name" class="form-label text-muted">Image : </label>
                            <br>
                            <img src="<?php echo  $path . htmlspecialchars($data["image"]) ?>" alt="" width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </div>
    <?php include "../../common.php" ?>
    <!-- Script for dashboard -->
    <script src="../../../../public/styles/bootstrap/bootstrap.min.js"></script>
    <script src="../../../../public/jscripts/common/common.js"></script>
</body>

</html>