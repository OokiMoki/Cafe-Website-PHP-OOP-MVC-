<?php 
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../public/styles/home/home.css"/>
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
      <div class="main-heading-text">Dino’s Cottage Cafe</div>
      <p class="main-sub-heading">
        Immerse yourself in a world of aromatic blends, personalized orders, and cozy ambiance, redefining
        your coffee experience.
      </p>
    </div>
    <div class="main-explore-button">
      <a href="#about-us-section" class="explore-button">
        <div class="scroll">Explore</div>
      </a>
    </div>
  </section>
  <!--End Of Main Section -->

  <!-- About Us Section Here -->
  <section class="about-us-container">
  <div class="about-us-text">
    <div id="about-us-section" class="about-us-heading-text">About Us</div>
      <p class="about-us-sub-heading"> 
        Nestled in the heart of the vibrant city, our café's tale started with a dream – 
        to craft a sanctuary where coffee lovers could escape the city's rush. Since 2005, 
        we've passionately curated remarkable coffee journeys that awaken the senses and weave bonds. 
        What began as a cozy corner for caffeine devotees has flourished into a cherished haven, 
        where tales entwine, connections flourish, and a fondness for artfully brewed elixirs thrives.
      </p>
    </div>
    <!--  About Us Button -->
    <div class="about-us-button">
      <a href="about">
      <button class="about-button">Read More</button>
    </div>
      </a>
  </div>
  <!--About Us Images -->
  <div class="about-us-images-container">
    <div class="about-us-image"></div>
    <div class="about-us-image2"></div>
    <div class="about-us-image3"></div>
 </div>
  </section>
  <!--End Of About Us Section -->

  <!-- Our Food Section Here -->
  <section class="our-food-container">
    <div class="our-food-text">
      <div class="our-food-heading-text">Our Foods</div>
      <p class ="our-food-sub-heading">
        "Step into the delightful world of our tucked-away cottage cafe within the bustling city. 
        Here, we pride ourselves on the art of coffee, sourcing only the finest beans from around 
        the globe to brew your perfect cup. And that's just the beginning – our extensive menu 
        boasts a bounty of culinary delights, ensuring there's something to satisfy every craving."
      </p>
    </div>
    <!-- Our Food Button -->
    <a href="menu">
    <div class="our-food-button">
      <button class="food-button">Explore Menu</button>
    </a>
    </div>

    <!-- Our Food Video -->
    <div class="our-food-video">
      <video id="our-video" controls autoplay loop>
        <source src="../../../public/assets/home/our-food-video.mp4" type="video/mp4">
      </video>
    </div>

    <!-- Online Order Section inside Our Food Section Here -->
    <section class="online-food-order-container">
      <div class="online-food-order-text">
        <div class="online-food-order-heading-text">OR</div>
        <p class="online-food-order-sub-heading">
          Order Online through our trusted platforms with fast delivery ~ 
          better service ~ cheaper options!
        </p>
      </div>

      <!-- Online Order Button inside Our Food Section Here -->
      <div class="online-food-order-button">
        <a href="https://www.ubereats.com/au" class="online-food-order-button">
          <img src="../../../public/assets/home/online-order1.png">
        </a>
        <a href="https://www.doordash.com/en-AU" class="online-food-order-button">
          <img src="../../../public/assets/home/online-order2.png">
        </a>
        <a href="https://www.menulog.com.au/" class="online-food-order-button">
          <img src="../../../public/assets/home/online-order3.jpg">
        </a>
      </div>
    </section>
  </section>
  <!-- End Of Our Food Section -->

  <!-- Main Booking Now Section -->
  <section class="main-booking-now-container">
    <div class="main-booking-now-text">
      <div class="main-booking-now-heading-text">Never <br>Miss Out</div>
      <p class="main-booking-now-sub-heading">
        Don’t want to wait? Why not book a table online? 
        We guarantee you a free table booking if you want to skip the rush and plan ahead! <br><br>
        Don’t forget to bring your creativity as you listen in to our live music and performance. <br><br>
        Don’t want to miss you! <br>
        So book now!!!!!!
      </p>
    </div>

  <!-- Main Booking Now Button -->
  <div class="main-booking-now-button">
    <a href="booking">
    <button class="main-booking-button">Book Now</button>
    </a>
  </div>
  </section>

  <!--Main Booking Now Images -->
  <div class="main-booking-now-image-container">
    <div class="main-booking-now-image"></div>
  </div>
  <!-- End of Our Main Booking Now Section -->

  <!-- FOOTER SECTION HERE -->
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
  <!-- End of Our Footer Section -->

    <!-- Link to the external JavaScript file -->
    <script src="../../../public/jscripts/home/script.js"></script>
    <!-- END -->
</body>
</html>  