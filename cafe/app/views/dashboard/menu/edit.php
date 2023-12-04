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
$get_menu = isset($_GET['menu']) && $_GET['menu'] != "" ? $_GET['menu'] : header("Location: ./manage.php");

if ($get_menu == 'breakfast_menu') {
    $data = $breakFastController->getMenuById($id);
    $path = '../../../../public/assets/breakfast/';
    $menu = "Breakfast Menu";
} elseif ($get_menu == 'lunch_menu') {
    $data = $lunchController->getMenuById($id);
    $path = '../../../../public/assets/lunch/';
    $menu = "Lunch Menu";
} elseif ($get_menu == 'dinner_menu') {
    $data = $dinnerController->getMenuById($id);
    $path = '../../../../public/assets/dinner/';
    $menu = "Dinner Menu";
} elseif ($get_menu == 'drinks_menu') {
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
    <title>Menu | Edit</title>
</head>

<body>
    <?php include "../components/sidebar.php" ?>
    <!-- Main Page -->

    <div class="container mt-5">
        <div class="bg-primary p-2 rounded-2 text-white">
            <h4 class="mb-0"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill mb-1" viewBox="0 0 16 16">
                    <circle cx="8" cy="8" r="8" />
                </svg>
                Edit Menu
            </h4>
            <span class="small ms-4">Menu > edit</span>
        </div>

        <div class="mt-4">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <form action="/app/core/menu/update_process.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="<?php echo htmlspecialchars($data['item_id']) ?>" name="id">
                        <input type="hidden" value="<?php echo htmlspecialchars($get_menu) ?>" name="menu">
                        <!-- Type -->
                        <div class="mb-3">
                            <label for="menu" class="form-label">Menu Type :</label>
                            <br>
                            <?php echo $get_menu == "breakfast_menu" ? "Breakfast Menu" : "" ?>
                            <?php echo $get_menu == "lunch_menu" ? "Lunch Menu" : "" ?>
                            <?php echo $get_menu == "dinner_menu" ? "Dinner Menu" : "" ?>
                            <?php echo $get_menu == "drinks_menu" ? "Drinks Menu" : "" ?>
                        </div>
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $data['name'] ?>" required>
                        </div>

                        <!-- Last Name -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo $data['price'] ?>" required>
                        </div>

                        <!-- Username -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" onchange="previewImage(event)" >
                        </div>
                        <img id="imagePreview" src="<?php echo $path . $data['image'] ?>" alt="Image Preview" style="max-width: 300px;">


                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                    <path d="M11 2H9v3h2z" />
                                    <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                                </svg>
                                Update
                            </button>
                        </div>
                    </form>
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