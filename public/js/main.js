// main.js
//
// This script manages the navigation bar's scroll behavior, responsive menu toggling, active state logic, and mobile dropdowns.
// Each section and function is commented to clarify its purpose and logic for future maintainers.

// Scroll event: toggles 'scrolled' class on navbar for sticky effect
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Responsive navigation menu toggle and padding adjustment
    const toggleButton = document.querySelector('[data-collapse-toggle="navbar-sticky"]');
    const navbarMenu = document.getElementById('navbar-sticky');
    const landingContent = document.querySelector('.landing-content');

    // Ensure all elements exist before adding listeners
    if (toggleButton && navbarMenu && landingContent) {
        // Reset navigation state when resizing to desktop
        const resetNavOnDesktop = () => {
            if (window.innerWidth > 792.1) { // Desktop breakpoint
                if (!navbarMenu.classList.contains('hidden')) {
                    navbarMenu.classList.add('hidden');
                    toggleButton.setAttribute('aria-expanded', 'false');
                    landingContent.style.paddingTop = '';
                }
            }
        };

        // Toggle mobile menu and adjust landing content padding
        toggleButton.addEventListener('click', function() {
            const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
            toggleButton.setAttribute('aria-expanded', !isExpanded);
            navbarMenu.classList.toggle('hidden');
            if (!isExpanded && window.innerWidth <= 792.1) {
                // Add padding to landing content when menu is open on mobile
                const menuHeight = navbarMenu.offsetHeight;
                landingContent.style.paddingTop = menuHeight + 'px';
            } else {
                // Remove padding when menu is closed
                landingContent.style.paddingTop = '';
            }
        });

        // Listen for window resize to reset nav state
        window.addEventListener('resize', resetNavOnDesktop);
    }
    
    // Fallback: toggle menu and landing content padding if only toggleButton exists
    if (toggleButton) {
        toggleButton.addEventListener('click', function() {
            const expanded = toggleButton.getAttribute('aria-expanded') === 'true' || false;
            toggleButton.setAttribute('aria-expanded', !expanded);
            navbarMenu.classList.toggle('hidden');
            if (!expanded && landingContent) {
                const menuHeight = navbarMenu.offsetHeight;
                landingContent.style.paddingTop = menuHeight + 'px';
            } else if (landingContent) {
                landingContent.style.paddingTop = '0';
            }
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Improved active state logic for navigation
    const currentPath = window.location.pathname;
    const currentLocale = currentPath.startsWith('/en') ? 'en' : 'id';
    // Remove locale prefix to get the actual route
    const pathWithoutLocale = currentPath.replace(/^\/(id|en)/, '') || '/';
    // Define route mappings for active state
    const routeMappings = {
        '/': 'index',
        '/perusahaan-kami': 'company',
        '/our-company': 'company',
        '/brand-kami': 'brand',
        '/our-brand': 'brand',
        '/produk': 'products',
        '/products': 'products',
        '/resep': 'recipes',
        '/recipes': 'recipes',
        '/info-karir': 'careerinfo',
        '/career-info': 'careerinfo',
        '/lowongan': 'vacancies',
        '/vacancies': 'vacancies'
    };
    // Get current route name
    let currentRoute = routeMappings[pathWithoutLocale];
    // Check for detail pages
    if (!currentRoute) {
        if (pathWithoutLocale.match(/^\/(produk|product|products)\/[\w-]+$/)) {
            currentRoute = 'products';
        } else if (pathWithoutLocale.match(/^\/(resep|recipe|recipes)\/[\w-]+$/)) {
            currentRoute = 'recipes';
        } else if (pathWithoutLocale.match(/^\/(lowongan|vacancy|vacancies)\/[\w-]+$/)) {
            currentRoute = 'vacancies';
        }
    }
    // Apply active state to navigation items
    if (currentRoute) {
        // Main navigation items
        const navLinks = {
            'company': document.getElementById('nav-company'),
            'brand': document.getElementById('nav-brand'),
            'products': document.getElementById('nav-products'),
            'recipes': document.getElementById('nav-recipes')
        };
        // Highlight the correct nav item
        if (navLinks[currentRoute]) {
            navLinks[currentRoute].classList.add('text-custom-lightgreen', 'active-nav-item');
            navLinks[currentRoute].classList.remove('text-white');
        }
        // Handle career dropdown highlighting
        if (currentRoute === 'careerinfo' || currentRoute === 'vacancies') {
            const careerDropdown = document.getElementById('career-dropdown');
            if (careerDropdown) {
                careerDropdown.classList.add('text-custom-lightgreen', 'active-nav-item');
                careerDropdown.classList.remove('text-white');
                // Add active state to parent group
                const parentGroup = careerDropdown.closest('.group');
                if (parentGroup) {
                    parentGroup.classList.add('active-dropdown');
                }
                // Highlight specific dropdown item
                if (currentRoute === 'careerinfo') {
                    const careerInfoLink = document.getElementById('career-info');
                    if (careerInfoLink) {
                        careerInfoLink.classList.add('bg-custom-lightergreen', 'text-white');
                    }
                } else if (currentRoute === 'vacancies') {
                    const vacanciesLink = document.getElementById('career-vacancies');
                    if (vacanciesLink) {
                        vacanciesLink.classList.add('bg-custom-lightergreen', 'text-white');
                    }
                }
            }
        }
    }
    // Mobile menu dropdown functionality
    if (window.innerWidth <= 792) {
        const dropdownButtons = document.querySelectorAll('.group button');
        dropdownButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdownMenu = this.nextElementSibling;
                if (dropdownMenu && dropdownMenu.classList.contains('group-hover:block')) {
                    dropdownMenu.classList.toggle('hidden');
                }
            });
        });
    }
});