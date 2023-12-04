<?php
session_start();
require_once __DIR__ . '../../../controllers/BreakfastController.php';
require_once __DIR__ . '../../../models/BreakfastModel.php';
require_once __DIR__ . '../../../core/Database.php';

// Example usage in breakfast.php
$breakfastController = new controller\BreakfastController(new \model\BreakfastModel(new \core\Database()));
$menuItems = $breakfastController->getBreakfastMenu();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/breakfast/breakfast.css">
    <title>Breakfast Menu</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Breakfast Menu</div>
        <ul class="menu">
            <li><a href="/home">Home</a></li>
            <li><a href="/menu">Menu</a></li>
            <li><a href="/cart">Cart</a></li>
        </ul>
    </nav>

    <!-- Content -->
    <section class="menu-option-container">
    <?php
        foreach ($menuItems as $menuItem) {
            echo '<div class="menu-item">';
            // Update the image source
            echo '<img class="menu-image" src="../../../public/assets/breakfast/' . $menuItem['image'] . '" alt="' . $menuItem['name'] . '">';
            echo '<h3 class="menu-name">' . $menuItem['name'] . '</h3>';
            echo '<p class="menu-price">' . $menuItem['price'] . '</p>';
            echo '<button class="add-to-cart" onclick="addToCart(\'' . $menuItem['name'] . '\', \'' . $menuItem['price'] . '\')">Add to Cart</button>';
            echo '</div>';
        }
    ?>
    </section>

    <script src="../../../public/jscripts/breakfast/breakfast.js"></script>
</body>
</html>
