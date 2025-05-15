// Make sure navbar is solid red on vacancy detail page
    document.addEventListener('DOMContentLoaded', function() {
        // Force navbar to have background color on vacancy detail page
        var navbar = document.getElementById('navbar');
        if (navbar) {
            navbar.classList.add('bg-custom-red');
            navbar.classList.add('scrolled');
        }
        
        // Force header to have minimal height
        var header = document.querySelector('header.landing');
        if (header) {
            header.style.minHeight = '21vh';
            header.style.height = 'auto';
            header.style.background = '#BF161C';
            header.style.display = 'block';
        }
    });