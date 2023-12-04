<?php
// Start a session to manage user data across requests
session_start();

// Check if the request method is POST and if an 'action' parameter is set
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    // Handle different actions based on the 'action' parameter
    switch ($_POST['action']) {
        // If the action is to add an item to the cart
        case 'add_to_cart':
            // Call the addToCart function with item name and price parameters
            addToCart($_POST['item_name'], $_POST['item_price']);
            break;
        // Add more cases for other cart actions if needed
    }
}

/**
 * Function to add an item to the user's cart.
 *
 * @param string $itemName The name of the item to be added.
 * @param float $itemPrice The price of the item to be added.
 *
 * @return void This function does not return a value.
 */
function addToCart($itemName, $itemPrice) {
    // Create a cart array if it doesn't exist in the session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Add the selected item to the user's cart
    $_SESSION['cart'][] = ['name' => $itemName, 'price' => $itemPrice];

    // Output the current state of the user's cart for debugging (you may remove this in production)
    var_dump($_SESSION['cart']);

    // Return a JSON response indicating success and a message
    echo json_encode(['status' => 'success', 'message' => 'Item added to the cart']);

    // Terminate the script to prevent further execution
    exit();
}
?>
