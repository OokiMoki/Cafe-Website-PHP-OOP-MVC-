    // script.js

    // SCROLLING FOR BUTTONS HERE //

    // read more button scrolls to the our history section
    const readmoreButton = document.querySelector('.read-more-button');
    readmoreButton.addEventListener('click', function (event) {
      event.preventDefault();
      const targetSection = document.querySelector('#our-history-section');
      targetSection.scrollIntoView({
        behavior: 'smooth'
      });
    });

     // history button scrolls to the our workers section
     const seemorehistoryButton = document.querySelector('.history-button');
    seemorehistoryButton.addEventListener('click', function (event) {
      event.preventDefault();
      const targetSection = document.querySelector('#our-workers-section');
      targetSection.scrollIntoView({
        behavior: 'smooth'
      });
    });

    // workers button scrolls to the our roasts section
    const seemoreworkersButton = document.querySelector('.workers-button');
    seemoreworkersButton.addEventListener('click', function (event) {
      event.preventDefault();
      const targetSection = document.querySelector('#our-roasts-section');
      targetSection.scrollIntoView({
        behavior: 'smooth'
      });
    });

    // workers button scrolls to the our roasts section
    const gobackButton = document.querySelector('.roast-button');
    gobackButton.addEventListener('click', function (event) {
      event.preventDefault();
      const targetSection = document.querySelector('#main-section');
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