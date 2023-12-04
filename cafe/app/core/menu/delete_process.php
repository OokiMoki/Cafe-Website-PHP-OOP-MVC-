<?php
// Include necessary files
require_once '../Database.php';

require_once '../../models/BreakfastModel.php';
require_once '../../controllers/BreakfastController.php';

require_once '../../models/LunchModel.php';
require_once '../../controllers/LunchController.php';

require_once '../../models/DinnerModel.php';
require_once '../../controllers/DinnerController.php';

require_once '../../models/DrinksModel.php';
require_once '../../controllers/DrinksController.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start a session
    session_start();

    // Initialize Database, Models, and Controllers
    $database = new \core\Database();

    // Create instances of BreakfastModel and BreakfastController
    $breakFastModel = new \model\BreakfastModel($database);
    $breakFastController = new \controller\BreakfastController($breakFastModel);

    // Create instances of LunchModel and LunchController
    $lunchModel = new \model\LunchModel($database);
    $lunchController = new \controller\LunchController($lunchModel);

    // Create instances of DinnerModel and DinnerController
    $dinnerModel = new \model\DinnerModel($database);
    $dinnerController = new \controller\DinnerController($dinnerModel);

    // Create instances of DrinksModel and DrinksController
    $drinkModel = new \model\DrinksModel($database);
    $drinkController = new \controller\DrinksController($drinkModel);

    // Get data from the POST request
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $menu = isset($_GET['menu']) ? $_GET['menu'] : '';

    // Validate required fields
    if (empty($id)) {
        // Set an error message if the id field is empty
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Id field is required!"
        ];
        // Redirect to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Call the appropriate delete menu function based on the selected menu
        if ($menu == "breakfast_menu") {
            // Get menu details and delete the menu and associated image
            $getMenu = $breakFastController->getMenuById($id);
            deleteFile('../../../public/assets/breakfast/' . $getMenu['image']);
            deleteMenu($breakFastController, $id);
        } elseif ($menu == "lunch_menu") {
            $getMenu = $lunchController->getMenuById($id);
            deleteFile('../../../public/assets/lunch/' . $getMenu['image']);
            deleteMenu($lunchController, $id);
        } elseif ($menu == "dinner_menu") {
            $getMenu = $dinnerController->getMenuById($id);
            deleteFile('../../../public/assets/dinner/' . $getMenu['image']);
            deleteMenu($dinnerController, $id);
        } elseif ($menu == "drinks_menu") {
            $getMenu = $drinkController->getMenuById($id);
            deleteFile('../../../public/assets/drinks/' . $getMenu['image']);
            deleteMenu($drinkController, $id);
        }

        // Redirect to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// Function to delete a menu
function deleteMenu($controller, $id)
{
    if ($controller->deleteMenu($id)) {
        // Menu deletion successful, set success message
        $_SESSION['message'] = [
            "type" => "success",
            "description" => "Menu deleted successful!"
        ];
    } else {
        // Menu deletion failed, set error message
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Menu delete failed."
        ];
    }
    // Redirect to the previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

// Function to delete a file
function deleteFile($filePath)
{
    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            return true;
        } else {
            // Set an error message if file deletion fails
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "Error deleting file."
            ];
            return false;
        }
    } else {
        // Set an error message if the file does not exist
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "File does not exist."
        ];
        return false;
    }
}
?>
