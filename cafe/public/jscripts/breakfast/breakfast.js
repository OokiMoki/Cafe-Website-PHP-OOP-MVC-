function addToCart(name, price) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../../../app/controllers/CartController.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            console.log(response);

            // Update UI or show a notification
            showCartNotification(response.message);
        }
    };

    xhr.send('action=add_to_cart&item_name=' + encodeURIComponent(name) + '&item_price=' + encodeURIComponent(price));
}

function showCartNotification(message) {
    // Your notification logic
    console.log(message);
}
