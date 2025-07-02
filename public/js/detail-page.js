// detail-page.js
//
// This script customizes the appearance of the navbar and header on the vacancy detail page.
// It ensures the navbar is solid red and the header has a minimal height and solid background for visual consistency.

document.addEventListener('DOMContentLoaded', function() {
    // Force navbar to have a solid red background and scrolled state
    var navbar = document.getElementById('navbar');
    if (navbar) {
        navbar.classList.add('bg-custom-red');
        navbar.classList.add('scrolled');
    }
    
    // Set header (landing section) to minimal height and solid red background
    var header = document.querySelector('header.landing');
    if (header) {
        header.style.minHeight = '21vh';
        header.style.height = 'auto';
        header.style.background = '#BF161C';
        header.style.display = 'block';
    }
});