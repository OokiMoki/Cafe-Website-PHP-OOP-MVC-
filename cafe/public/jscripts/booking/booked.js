// Countdown timer
let seconds = 5;

function updateCountdown() {
    document.getElementById('countdown').textContent = seconds;
}

function redirect() {
    window.location.href = "/home"; // Replace with the actual home page URL
}

function startCountdown() {
    updateCountdown();
    const countdownInterval = setInterval(function() {
        seconds--;
        updateCountdown();
        if (seconds <= 0) {
            clearInterval(countdownInterval);
            redirect();
        }
    }, 1000);
}

// Start the countdown when the page loads
document.addEventListener('DOMContentLoaded', startCountdown);