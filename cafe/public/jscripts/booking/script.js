    // script.js

    // book now button scrolls to the about us section
    const booknowButton = document.querySelector('.book-now-button');
    booknowButton.addEventListener('click', function (event) {
      event.preventDefault();
      const targetSection = document.querySelector('#table-booking-form-section');
      targetSection.scrollIntoView({
        behavior: 'smooth'
      });
    });

    // dino's button in footer scrolls to the main section
    const dinosButton = document.querySelector('.main-footer-logo-button');
    dinosButton.addEventListener('click', function (event) {
      event.preventDefault();
      const targetSection = document.querySelector('#main-section');
      targetSection.scrollIntoView({
        behavior: 'smooth'
      });
    });

    function validateForm() {
      // Get values from the form
      var date = document.getElementById('date').value;
      var time = document.getElementById('time').value;
      var firstName = document.getElementById('firstName').value;
      var lastName = document.getElementById('lastName').value;
      var adults = document.getElementById('adults').value;
      var children = document.getElementById('children').value;
      var phone = document.getElementById('phone').value;
      var email = document.getElementById('email').value;
      var requests = document.getElementById('requests').value;

      // Validate if any field is empty
      if (date === '' || time === '' || firstName === '' || lastName === '' || adults === '' || children === '' || phone === '' || email === '' || requests === '') {
        alert('Input details!'); // You can replace this with a more stylish error message or use a modal
        return false;
      }

      // If all fields are filled, allow form submission
      return true;
    }

    