<?php
require_once __DIR__ . '../../../controllers/DrinksController.php';
require_once __DIR__ . '../../../models/DrinksModel.php';
require_once __DIR__ . '../../../core/Database.php';    

// Example usage in breakfast.php
$drinksController = new controller\DrinksController(new \model\DrinksModel(new \core\Database()));
$menuItems = $drinksController->getDrinksMenu();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/drinks/drinks.css">
    <title>Drinks Menu</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Drinks Menu</div>
        <ul class="menu">
        <li><a href="/home">Home</a></li>
            <li><a href="/menu">Menu</a></li>
            <li><a href="/cart">Cart</a></li>
        </ul>
    </nav>

    <!-- Added to Cart Notification -->
    <div id="cart-notification" class="cart-notification">
        <span id="cart-message"></span>
    </div>

    <!-- Content -->
    <section class="menu-option-container">
        <?php
            // Display menu items
            foreach ($menuItems as $menuItem) {
                echo '<div class="menu-item">';
                // Update the image source
                echo '<img class="menu-image" src="../../../public/assets/drinks/' . $menuItem['image'] . '" alt="' . $menuItem['name'] . '">';
                echo '<h3 class="menu-name">' . $menuItem['name'] . '</h3>';
                echo '<p class="menu-price">' . $menuItem['price'] . '</p>';
                echo '<button class="add-to-cart" onclick="addToCart(\'' . $menuItem['name'] . '\', \'' . $menuItem['price'] . '\')">Add to Cart</button>';
                echo '</div>';
            }
        ?>
    </section>

    <script src="../../../public/jscripts/drinks/drinks.js"></script>
</body>
</html>

