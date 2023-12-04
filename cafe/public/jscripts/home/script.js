// script.js

// SCROLLING FOR BUTTONS HERE //

// explore button scrolls to the about us section
const exploreButton = document.querySelector('.explore-button');
exploreButton.addEventListener('click', function (event) {
  event.preventDefault();
  const targetSection = document.querySelector('#about-us-section');
  targetSection.scrollIntoView({
    behavior: 'smooth'
  });
});

// dino's button in footer scrolls to the main section
const dinoButton = document.querySelector('.main-footer-logo-button');
dinoButton.addEventListener('click', function (event) {
  event.preventDefault();
  const targetSection = document.querySelector('#main-section');
  targetSection.scrollIntoView({
    behavior: 'smooth'
  });
});