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
    $menu = isset($_POST['menu']) ? $_POST['menu'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $image = isset($_FILES['image']) ? $_FILES['image'] : '';

    // Validate required fields
    if (empty($menu) || empty($name) || empty($price) || empty($image)) {
        // Set an error message if required fields are empty
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "All fields are required!"
        ];
        // Redirect to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Call the appropriate menu creation function based on the selected menu
        if ($menu == "breakfast_menu") {
            // Upload image and create breakfast menu
            $path = uploadImage('../../../public/assets/breakfast/', $_FILES['image']);
            if (!$path) {
                // Set an error message if image upload fails
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            breakFastMenuCreate($breakFastController, $name, $price, $path);
        } elseif ($menu == "lunch_menu") {
            // Upload image and create lunch menu
            $path = uploadImage('../../../public/assets/lunch/', $_FILES['image']);
            if (!$path) {
                // Set an error message if image upload fails
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            lunchMenuCreate($lunchController, $name, $price, $path);
        } elseif ($menu == "dinner_menu") {
            // Upload image and create dinner menu
            $path = uploadImage('../../../public/assets/dinner/', $_FILES['image']);
            if (!$path) {
                // Set an error message if image upload fails
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            dinnerMenuCreate($dinnerController, $name, $price, $path);
        } elseif ($menu == "drinks_menu") {
            // Upload image and create drinks menu
            $path = uploadImage('../../../public/assets/drinks/', $_FILES['image']);
            if (!$path) {
                // Set an error message if image upload fails
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
            drinksMenuCreate($drinkController, $name, $price, $path);
        }

        // Redirect to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// Function to upload an image
function uploadImage($path, $image)
{
    // Specify the directory where you want to store uploaded images
    $uploadDir = $path;
    $uploadFile = $uploadDir . basename($image['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    // Check if the file is a valid image
    $check = getimagesize($image['tmp_name']);
    if ($check !== false) {
        // Check if the file already exists
        if (!file_exists($uploadFile)) {
            // Check if the file size is within limits (adjust as needed)
            if ($image['size'] <= 5000000) {
                // Check if the image file type is allowed (you can extend this list)
                if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
                    // Move the uploaded file to the specified directory
                    if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
                        return basename($image['name']);
                    } else {
                        // Set an error message if image move fails
                        $_SESSION['message'] = [
                            "type" => "error",
                            "description" => "Error uploading image."
                        ];
                        return false;
                    }
                } else {
                    // Set an error message for unsupported file types
                    $_SESSION['message'] = [
                        "type" => "error",
                        "description" => "Only JPG, JPEG, PNG, and GIF files are allowed."
                    ];
                    return false;
                }
            } else {
                // Set an error message if the file size exceeds the limit
                $_SESSION['message'] = [
                    "type" => "error",
                    "description" => "File size exceeds the limit."
                ];
                return false;
            }
        } else {
            // Set an error message if the file already exists
            $_SESSION['message'] = [
                "type" => "error",
                "description" => "File already exists."
            ];
            return false;
        }
    } else {
        // Set an error message if the file is not an image
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "File is not an image."
        ];
        return false;
    }
}

// Function to create a breakfast menu
function breakFastMenuCreate($controller, $name, $price, $image)
{
    // Assuming $controller is an instance of your controller class
    if ($controller->createMenu($name, $price, $image)) {
        // Menu creation successful, set success message
        $_SESSION['message'] = [
            "type" => "success",
            "description" => "Breakfast Menu creation successful!"
        ];
    } else {
        // Menu creation failed, set error message
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Menu creation failed. Username may already exist."
        ];
    }
}

// Function to create a lunch menu
function lunchMenuCreate($controller, $name, $price, $image)
{
    // Assuming $controller is an instance of your controller class
    if ($controller->createMenu($name, $price, $image)) {
        // Menu creation successful, set success message
        $_SESSION['message'] = [
            "type" => "success",
            "description" => "Lunch Menu creation successful!"
        ];
    } else {
        // Menu creation failed, set error message
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Menu creation failed. Username may already exist."
        ];
    }
}

// Function to create a dinner menu
function dinnerMenuCreate($controller, $name, $price, $image)
{
    // Assuming $controller is an instance of your controller class
    if ($controller->createMenu($name, $price, $image)) {
        // Menu creation successful, set success message
        $_SESSION['message'] = [
            "type" => "success",
            "description" => "Dinner Menu creation successful!"
        ];
    } else {
        // Menu creation failed, set error message
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Menu creation failed. Username may already exist."
        ];
    }
}

// Function to create a drinks menu
function drinksMenuCreate($controller, $name, $price, $image)
{
    // Assuming $controller is an instance of your controller class
    if ($controller->createMenu($name, $price, $image)) {
        // Menu creation successful, set success message
        $_SESSION['message'] = [
            "type" => "success",
            "description" => "Drinks Menu creation successful!"
        ];
    } else {
        // Menu creation failed, set error message
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Menu creation failed. Username may already exist."
        ];
    }
}
?>
