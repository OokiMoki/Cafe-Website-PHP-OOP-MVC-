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
    $menu = isset($_POST['menu']) ? $_POST['menu'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $image = isset($_FILES['image']) && $_FILES['image']['name'] != '' ? $_FILES['image'] : '';

    // Validate required fields
    if (empty($menu) || empty($name) || empty($price) || empty($id)) {
        // Set an error message if any required field is empty
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "All fields are required!"
        ];
        // Redirect to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {

        // Process the update based on the selected menu
        if ($menu == "breakfast_menu") {
            $getMenu = $breakFastController->getMenuById($id);
            if (!empty($image)) {
                deleteFile('../../../public/assets/breakfast/' . $getMenu['image']);
                $path = uploadImage('../../../public/assets/breakfast/', $_FILES['image']);
            } else {
                $path = $getMenu['image'];
            }
            breakFastMenuUpdate($breakFastController, $name, $price, $path, $id);
        } elseif ($menu == "lunch_menu") {
            $getMenu = $lunchController->getMenuById($id);
            if (!empty($image)) {
                deleteFile('../../../public/assets/lunch/' . $getMenu['image']);
                $path = uploadImage('../../../public/assets/lunch/', $_FILES['image']);
            } else {
                $path = $getMenu['image'];
            }
            lunchMenuUpdate($lunchController, $name, $price, $path, $id);
        } elseif ($menu == "dinner_menu") {
            $getMenu = $drinkController->getMenuById($id);
            if (!empty($image)) {
                deleteFile('../../../public/assets/dinner/' . $getMenu['image']);
                $path = uploadImage('../../../public/assets/dinner/', $_FILES['image']);
            } else {
                $path = $getMenu['image'];
            }
            dinnerMenuUpdate($dinnerController, $name, $price, $path, $id);
        } elseif ($menu == "drinks_menu") {
            $getMenu = $drinkController->getMenuById($id);
            if (!empty($image)) {
                deleteFile('../../../public/assets/drinks/' . $getMenu['image']);
                $path = uploadImage('../../../public/assets/drinks/', $_FILES['image']);
            } else {
                $path = $getMenu['image'];
            }
            drinksMenuUpdate($drinkController, $name, $price, $path, $id);
        }

        // Redirect to the previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

// Function to upload an image
function uploadImage($path, $image)
{
    $uploadDir = $path;  // Specify the directory where you want to store uploaded images
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
                        // Set an error message if image upload fails
                        $_SESSION['message'] = [
                            "type" => "error",
                            "description" => "Error uploading image."
                        ];
                        return false;
                    }
                } else {
                    // Set an error message if the image file type is not allowed
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

// Function to update a breakfast menu
function breakFastMenuUpdate($controller, $name, $price, $image, $id)
{
    // Assuming $controller is an instance of your controller class
    if ($controller->updateMenu($id, $name, $price, $image)) {
        // Update successful, set success message
        $_SESSION['message'] = [
            "type" => "success",
            "description" => "Breakfast Menu update successful!"
        ];
        return true;
    } else {
        // Update failed, set error message
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Menu update failed. Username may already exist."
        ];
        return false;
    }
}

// Function to update a lunch menu
function lunchMenuUpdate($controller, $name, $price, $image, $id)
{
    // Assuming $controller is an instance of your controller class
    if ($controller->updateMenu($id, $name, $price, $image)) {
        // Update successful, set success message
        $_SESSION['message'] = [
            "type" => "success",
            "description" => "Lunch Menu update successful!"
        ];
        return true;
    } else {
        // Update failed, set error message
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Menu update failed. Username may already exist."
        ];
        return false;
    }
}

// Function to update a dinner menu
function dinnerMenuUpdate($controller, $name, $price, $image, $id)
{
    // Assuming $controller is an instance of your controller class
    if ($controller->updateMenu($id, $name, $price, $image)) {
        // Update successful, set success message
        $_SESSION['message'] = [
            "type" => "success",
            "description" => "Dinner Menu update successful!"
        ];
        return true;
    } else {
        // Update failed, set error message
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Menu update failed. Username may already exist."
        ];
        return false;
    }
}

// Function to update a drinks menu
function drinksMenuUpdate($controller, $name, $price, $image, $id)
{
    // Assuming $controller is an instance of your controller class
    if ($controller->updateMenu($id, $name, $price, $image)) {
        // Update successful, set success message
        $_SESSION['message'] = [
            "type" => "success",
            "description" => "Drinks Menu update successful!"
        ];
        return true;
    } else {
        // Update failed, set error message
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Menu update failed. Username may already exist."
        ];
        return false;
    }
}

// Function to move a file
function moveFile($sourcePath, $destinationPath)
{
    if (rename($sourcePath, $destinationPath)) {
        return true;
    } else {
        // Set an error message if file movement fails
        $_SESSION['message'] = [
            "type" => "error",
            "description" => "Error moving file."
        ];
        return false;
    }
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
