<?php
session_start();
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/cart/cart.css">
    <title>Your Cart</title>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">Your Cart</div>
        <ul class="menu">
            <li><a href="/home">Home</a></li>
            <li><a href="/menu">Menu</a></li>
            <li><a href="/cart">Cart</a></li>
        </ul>
    </nav>

    <div class="cart-container">
        <!-- Left side: Display items in the cart -->
        <div class="summary-box section">
            <h2>Item Summary</h2>

            <?php
            // Display cart items
            if (!empty($cartItems)) {
                $summary = [];
                
                foreach ($cartItems as $cartItem) {
                    // Check if the necessary keys exist in the $cartItem array
                    if (isset($cartItem['name'], $cartItem['price'])) {
                        $itemName = $cartItem['name'];
                        $itemPrice = $cartItem['price'];
                        
                        // If the item is not in the summary array, add it
                        if (!isset($summary[$itemName])) {
                            $summary[$itemName] = [
                                'quantity' => 1,
                                'totalPrice' => $itemPrice
                            ];
                        } else {
                            // If the item is already in the summary array, increment the quantity and total price
                            $summary[$itemName]['quantity']++;
                            $summary[$itemName]['totalPrice'] += $itemPrice;
                        }
                    }
                }

                // Display the summary
                foreach ($summary as $itemName => $itemDetails) {
                    echo '<p>' . $itemName . ' x' . $itemDetails['quantity'] . ' - $' . number_format($itemDetails['totalPrice'], 2) . '</p>';
                }
            } else {
                echo '<p>Your cart is empty.</p>';
            }
            ?>
        </div>

        <!-- Middle side: User form details -->
    <div class="user-details section">
        <div class="contact-box">
            <h2>Contact</h2>
            <!-- Your existing user details form -->
            <form id="contact-form" onsubmit="return validateForm()">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first_name" required>

                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last_name" required>

                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </form>
        </div>

    <div class="delivery-box">
        <h2>Delivery Options</h2>
        <!-- Your existing delivery options -->
        <form id="delivery-form">
            <label for="delivery-option">Choose Delivery Option:</label>
            <select id="delivery-option" name="delivery_option" required>
                <option value="delivery">Delivery (+$3.00)</option>
                <option value="pickup">Pickup (Free)</option>
            </select>
        </form>
    </div>
</div>

<!-- Right side: Order summary -->
<div class="order-summary section">
    <div class="total-box">
        <h2>TOTAL</h2>
        <?php
        if (!empty($cartItems)) {
            $totalPrice = array_sum(array_column($summary, 'totalPrice'));
            ?>
            <p>Total Price: $<?php echo number_format($totalPrice, 2); ?></p>
            <p>Delivery Fee: $3.00</p>
            <p class="total">Total: $<?php echo number_format($totalPrice + 3, 2); ?></p>
            <?php
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>
        <form id="confirm-order-form">
            <button class="confirm-order">Confirm Order</button>
        </form>
    </div>
</div>

<script src="../../../public/jscripts/cart/cart.js"></script>
</body>
</html>
