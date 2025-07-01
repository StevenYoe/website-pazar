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

    // Pastikan elemen ada
    if (toggleButton && navbarMenu && landingContent) {
        // Fungsi untuk mereset state navigasi saat layar diperbesar
        const resetNavOnDesktop = () => {
            if (window.innerWidth > 792.1) { // Breakpoint untuk desktop
                if (!navbarMenu.classList.contains('hidden')) {
                    navbarMenu.classList.add('hidden');
                    toggleButton.setAttribute('aria-expanded', 'false');
                    landingContent.style.paddingTop = ''; // Hapus inline style
                }
            }
        };

        toggleButton.addEventListener('click', function() {
            const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
            toggleButton.setAttribute('aria-expanded', !isExpanded);
            navbarMenu.classList.toggle('hidden');

            if (!isExpanded && window.innerWidth <= 792.1) {
                // Hanya tambahkan padding di mobile saat menu dibuka
                const menuHeight = navbarMenu.offsetHeight;
                landingContent.style.paddingTop = menuHeight + 'px';
            } else {
                // Hapus padding saat menu ditutup
                landingContent.style.paddingTop = '';
            }
        });

        // Tambahkan event listener untuk resize
        window.addEventListener('resize', resetNavOnDesktop);
    }
    
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
    // IMPROVED ACTIVE STATE LOGIC
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
    
    // Check if we're on a detail page
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
        // Handle main navigation items
        const navLinks = {
            'company': document.getElementById('nav-company'),
            'brand': document.getElementById('nav-brand'),
            'products': document.getElementById('nav-products'),
            'recipes': document.getElementById('nav-recipes')
        };
        
        // Apply active class to the correct nav item
        if (navLinks[currentRoute]) {
            navLinks[currentRoute].classList.add('text-custom-lightgreen', 'active-nav-item');
            navLinks[currentRoute].classList.remove('text-white');
        }
        
        // Handle career dropdown
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