<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/booking/booking.css" />
</head>
<body>
  <!-- Navigation Bar Here -->
  <nav class="nav">
    <ul class="ul">
      <li class="dinos">Dino's</li>
      <li class="li"><a href="/home">Home</a></li>
      <li class="li"><a href="/about">About</a></li>
      <li class="li"><a href="/menu">Menu</a></li>
      <li class="li"><a href="/booking">Booking</a></li>
      <li class="li"><a href="/login">Login</a></li>
      <li class="li"><a href="/cart">Cart</a></li>
    </ul>
  </nav>
  <!-- Main Section Here -->
  <section id="main-section" class="background-container">
    <div class="main-text">
      <div class="main-heading-text">Table Booking</div>
      <p class="main-sub-heading">
        Don’t want to wait in line?Make a reservation to secure your spot.
      </p>
    </div>
    <div class="main-book-now-button">
      <a href="#table-booking-form-section" class="book-now-button">
        <div class="scroll">Book Now</div>
      </a>
    </div>
  </section>
  <!--End Of Main Section -->

  <!-- Booking Form Section Here -->
  <section id="table-booking-form-section" class="table-booking-form-container">
    <form id="bookingForm" action="booking_reserved" onsubmit="return validateForm()">
        <!-- Date Input -->
        <input type="date" id="date" placeholder="Date" required pattern="[0-9]{4}-W([0-4][0-9]|5[0-2])">

        <!-- Time Input -->
        <select id="time" required>
        <option value="" disabled selected hidden>Time</option>
          <!--BREAKFAST TIME -->
          <option value="08:30">8:30 AM</option>
          <option value="08:40">8:40 AM</option>
          <option value="08:50">8:50 AM</option>
          <option value="09:00">9:00 AM</option>
          <option value="10:30">10:30 AM</option>
          <option value="10:40">10:40 AM</option>
          <option value="10:50">10:50 AM</option>
          <option value="11:00">11:00 AM</option>
          <!-- LUNCH TIME -->
          <option value="11:30">11:30 AM</option>
          <option value="11:40">11:40 AM</option>
          <option value="11:50">11:50 AM</option>
          <option value="12:00">12:00 PM</option>
          <option value="12:10">12:10 PM</option>
          <option value="12:20">12:20 PM</option>
          <option value="12:30">12:30 PM</option>
          <option value="12:40">12:40 PM</option>
          <!-- AFTERNOON TIME -->
          <option value="14:00">2:00 PM</option>
          <option value="14:30">2:30 PM</option>
          <option value="14:40">2:40 PM</option>
          <option value="14:50">2:50 PM</option>
          <option value="15:00">3:00 PM</option>
          <option value="15:10">3:10 PM</option>
          <option value="15:20">3:20 PM</option>
          <option value="15:30">3:30 PM</option>
          <!-- DINNER TIME -->
          <option value="16:00">4:00 PM</option>
          <option value="16:10">4:10 PM</option>
          <option value="16:20">4:20 PM</option>
          <option value="16:30">4:30 PM</option>
          <option value="16:40">4:40 PM</option>
          <option value="16:50">4:50 PM</option>
          <option value="17:00">5:00 PM</option>
        </select><br>

        <!-- Name Input-->
        <input type="text" id="firstName" placeholder="FirstName" required>

        <input type="text" id="lastName" placeholder="LastName" required><br>
        
        <!-- Number of Attendees Input -->
        <input type="number" id="adults" min="1"  placeholder="Adults Attending" required>

        <input type="number" id="children" min="0" placeholder="Children Attending" required><br>

         <!-- Phone Number and Email Input -->
        <input type="tel" id="phone" pattern="[0-9]{10}" placeholder="Phone Number" required>
        
        <input type="email" id="email" placeholder="Email Address" required><br>
        
        <!-- Special Requests Input -->
        <textarea id="requests" rows="4" placeholder="Special Requests"></textarea><br>

        <!-- Reserve Now Button -->
        <div class="booking-reserve-button">
          <button type="submit" class="reserve-button">Reserve Now</a>
        </div>
    </form>
  </section>

  <!-- Footer Section Here -->
  <section class="main-page-footer-container">
    <!-- Main Footer Logo Button -->
    <div class="main-footer-button">
      <a href="#main-section" class="main-footer-logo-button">
        <div class="scroll">Dino's</div>
      </a>
    </div>

    <div class ="main-footer-text">
      <div class="main-footer-heading-text">Stay In The Loop</div>
      <p class="main-footer-sub-heading">
        This form is protected by reCAPTCHA and the Google<br>
        Privacy Policy and Terms of Service apply.
      </p>
    </div>

    <!-- Footer Payment Image Here -->
    <div class="main-footer-image-container">
      <div class="footer-payment-image"></div>
    </div>
  </section>

  <!-- Link to the external JavaScript file -->
  <script src="../../../public/jscripts/booking/booking.js"></script>

</body>
</html>