// JavaScript function to validate form fields
function validateForm() {
    // Get values from the form
    var firstName = document.getElementById('first-name').value;
    var lastName = document.getElementById('last-name').value;
    var phone = document.getElementById('phone').value;
    var address = document.getElementById('address').value;
    var deliveryOption = document.getElementById('delivery-option').value;

    // Validate if any field is empty
    if (firstName === '' || lastName === '' || phone === '' || address === '' || deliveryOption === '') {
        alert('Please fill out all required fields.');
        return false;
    }

    // If all fields are filled, allow form submission
    return true;
}

document.getElementById('confirm-order-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission
    if (validateForm()) {
        var deliveryOption = document.getElementById('delivery-option').value;

        if (deliveryOption === 'delivery') {
            // If delivery is selected, redirect to delivery page
            setTimeout(function () {
                window.location.href = '/app/views/cart/deliverycartconfirmed.php';
            }, 5000);
        } else {
            // If pickup is selected, redirect to pickup page
            setTimeout(function () {
                window.location.href = '/app/views/cart/pickupcartconfirmed.php';
            }, 5000);
        }
    }
});

function removeFromCart(itemIndex) {
var xhr = new XMLHttpRequest();
xhr.open('POST', '../../app/controllers/CartController.php', true);
xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
        console.log('Response from server:', xhr.responseText);

        if (xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                console.log(response);

                // Update UI or show a notification
                showCartNotification(response.message);

                // Optionally, update the cart display after removal
                updateCartDisplay();
            } catch (error) {
                console.error('Error parsing JSON:', error);
            }
        } else {
            console.error('Request failed with status:', xhr.status);
        }
    }
};

xhr.send('action=remove_from_cart&item_index=' + encodeURIComponent(itemIndex));
}

function updateCartDisplay() {
// Implement UI updates as needed
// For example, you can reload the page or update the cart summary
location.reload(); // This reloads the entire page
}