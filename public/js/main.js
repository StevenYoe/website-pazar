// JavaScript for scroll behavior
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.querySelector('[data-collapse-toggle="navbar-sticky"]');
    const navbarMenu = document.getElementById('navbar-sticky');
    const landingContent = document.querySelector('.landing-content');
    
    // Reset initial state
    function resetMobileNavState() {
        if (window.innerWidth <= 640) {
            navbarMenu.classList.add('hidden');
            landingContent.style.paddingTop = '0';
        }
    }
    
    // Initial setup
    resetMobileNavState();
    
    // Handle dropdown attributes
    if (window.innerWidth <= 792) {
        document.querySelectorAll('[data-dropdown-toggle], [data-dropdown-trigger]')
            .forEach(el => el.removeAttribute('data-dropdown-toggle'));
    }
    
    // Handle resize events
    window.addEventListener('resize', resetMobileNavState);
    
    toggleButton.addEventListener('click', function() {
        const expanded = toggleButton.getAttribute('aria-expanded') === 'true' || false;
        toggleButton.setAttribute('aria-expanded', !expanded);
        navbarMenu.classList.toggle('hidden');
        
        if (!expanded) {
            const menuHeight = navbarMenu.offsetHeight;
            landingContent.style.paddingTop = menuHeight + 'px';
        } else {
            landingContent.style.paddingTop = '0';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // PART 1: Handle direct links by URL path
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll('nav a[href]');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath) {
            // For direct navigation links
            link.classList.add('text-custom-lightgreen');
        }
    });
    
    // PART 2: Handle dropdown menus by route name
    const currentPage = document.body.getAttribute('data-page');
    
    // Navigation configuration for dropdowns only
    const dropdownConfig = {
        'careerinfo': { 
            dropdownId: 'career-dropdown', 
            activeIds: ['career-info'], 
            type: 'dropdown' 
        },
        'vacancies': { 
            dropdownId: 'career-dropdown', 
            activeIds: ['career-vacancies'], 
            type: 'dropdown' 
        }
    };
    
    const config = dropdownConfig[currentPage];
    
    if (config && config.type === 'dropdown') {
        // Style the dropdown button
        const dropdownButton = document.getElementById(config.dropdownId);
        if (dropdownButton) {
            // Use !important to ensure the text color takes precedence
            dropdownButton.style.setProperty('color', 'var(--color-custom-lightgreen)', 'important');
            // Also add the class for consistency
            dropdownButton.classList.add('text-custom-lightgreen');
            
            // Handle dropdown visibility if needed
            const parentGroup = dropdownButton.closest('.group');
            if (parentGroup) {
                parentGroup.classList.add('active-dropdown');
            }
        }
        
        // Highlight the specific active items within the dropdown
        config.activeIds.forEach(id => {
            const link = document.getElementById(id);
            if (link) {
                // Apply background color
                link.classList.add('bg-custom-lightergreen');
                
                // Apply white text color with high specificity
                link.style.setProperty('color', 'white', 'important');
                link.classList.add('text-white');
                
                // Remove any conflicting classes
                link.classList.remove('text-gray-700', 'dark:text-gray-200');
            }
        });
    }
});