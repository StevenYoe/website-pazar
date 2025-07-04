// main.js
//
// This script manages the navigation bar's scroll behavior, responsive menu toggling, active state logic, and mobile dropdowns.
// Each section and function is commented to clarify its purpose and logic for future maintainers.

// Scroll event: toggles 'scrolled' class on navbar for sticky effect
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (navbar) { // Added check for navbar existence
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    // Responsive navigation menu toggle and padding adjustment
    const toggleButton = document.querySelector('[data-collapse-toggle="navbar-sticky"]');
    const navbarMenu = document.getElementById('navbar-sticky');
    const navbar = document.getElementById('navbar'); // Get the main navbar element
    const landingContent = document.querySelector('.landing-content');

    /**
     * Calculates and applies the correct padding-top to the landingContent element.
     * This function ensures content is always pushed down correctly by the fixed navbar
     * and the expanded mobile menu (if active), while also adding desired spacing.
     */
    function updateLandingContentPadding() {
        // Ensure all required elements exist before proceeding
        if (!landingContent || !navbar || !navbarMenu) return;

        const navbarHeight = navbar.offsetHeight; // Get the height of the main fixed navbar
        let totalOffset = navbarHeight; // Selalu mulai dengan tinggi navbar untuk mendorong konten di bawah nav yang tetap

        const isNonIndexPage = landingContent.classList.contains('not-index');

        // Tentukan padding visual dasar yang diinginkan berdasarkan lebar layar DAN jenis halaman.
        // Nilai ini menggantikan padding dari Tailwind (mis. py-20) yang ditimpa oleh inline style JS.
        let baseVisualPaddingForContent = 0; 

        if (window.innerWidth <= 640) { // Layar mobile sangat kecil (<= 640px)
            if (isNonIndexPage) {
                // Untuk halaman non-indeks di layar sangat kecil: 80px (dari py-20) + 40px (ekstra) = 120px
                baseVisualPaddingForContent = 120;
            } else { // Halaman indeks di layar sangat kecil
                // Halaman indeks tetap 40px seperti permintaan sebelumnya.
                baseVisualPaddingForContent = -40;
            }
        } else { // Layar lebih besar dari 640px (mobile/tablet besar hingga desktop)
            if (isNonIndexPage) {
                // Untuk halaman non-indeks di layar > 640px: Dikurangi menjadi 40px (sebelumnya 80px)
                // Ini seharusnya mengatasi masalah "turun banget" pada rentang ini.
                baseVisualPaddingForContent = -40; 
            } else { // Halaman indeks di layar > 640px
                // Halaman indeks tetap 40px.
                baseVisualPaddingForContent = -120;
            }
        }

        totalOffset += baseVisualPaddingForContent;

        // Tambahkan tinggi menu hanya jika menu mobile terbuka dan relevan (untuk layar <= 792px)
        if (window.innerWidth <= 792 && !navbarMenu.classList.contains('hidden')) {
            const menuHeight = navbarMenu.offsetHeight;
            totalOffset += menuHeight;
        }

        // Terapkan calculated padding-top ke elemen landingContent
        landingContent.style.paddingTop = totalOffset + 'px';
    }

    // --- Initial Setup and Event Listeners for Navbar Toggle ---

    // 1. Initial State: Ensure the mobile menu is hidden on page load if on a mobile breakpoint
    //    and then update the landing content padding accordingly.
    if (navbarMenu && window.innerWidth <= 792) {
        navbarMenu.classList.add('hidden'); // Ensure it's hidden initially on mobile
    }
    updateLandingContentPadding(); // Apply initial padding on load

    // 2. Handle Window Resize Events:
    //    - If resizing to desktop, ensure the mobile menu is hidden.
    //    - Always recalculate padding after resize to adapt to new screen dimensions.
    window.addEventListener('resize', function() {
        if (navbarMenu && window.innerWidth > 792) { // Desktop breakpoint
            navbarMenu.classList.add('hidden'); // Always hide mobile menu on desktop
            // When resizing from mobile to desktop, also ensure aria-expanded is false
            if (toggleButton) {
                toggleButton.setAttribute('aria-expanded', 'false');
            }
        } else if (navbarMenu) { // Back to mobile range
            // On mobile resize, ensure menu is closed for accurate recalculation
            // (e.g., if phone rotated while menu was open, close it)
            navbarMenu.classList.add('hidden');
            if (toggleButton) {
                toggleButton.setAttribute('aria-expanded', 'false');
            }
        }
        updateLandingContentPadding(); // Recalculate padding on resize
    });

    // 3. Handle Mobile Menu Toggle Button Clicks:
    //    - Toggle the 'aria-expanded' attribute.
    //    - Toggle the 'hidden' class on the navbar menu.
    //    - Recalculate and apply padding after the menu's visibility has changed.
    if (toggleButton && navbarMenu && landingContent) { // Ensure all necessary elements exist for this listener
        toggleButton.addEventListener('click', function() {
            const isExpanded = toggleButton.getAttribute('aria-expanded') === 'true';
            toggleButton.setAttribute('aria-expanded', !isExpanded);

            // Toggle visibility FIRST, so offsetHeight reflects the new state correctly
            navbarMenu.classList.toggle('hidden');

            updateLandingContentPadding(); // Recalculate and apply padding after toggling
        });
    }

    // --- Active State Logic for Navigation Items ---
    // This section highlights the current page in the navigation bar.

    const currentPath = window.location.pathname;
    // const currentLocale = currentPath.startsWith('/en') ? 'en' : 'id'; // Not strictly needed for active state
    // Remove locale prefix to get the actual route path for mapping
    const pathWithoutLocale = currentPath.replace(/^\/(id|en)/, '') || '/';

    // Define route mappings for active state.
    // Maps URL paths (without locale) to internal route names used for nav IDs.
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

    let currentRoute = routeMappings[pathWithoutLocale];

    // Check for detail pages (e.g., /produk/some-slug)
    if (!currentRoute) {
        if (pathWithoutLocale.match(/^\/(produk|product)\/[\w-]+$/)) {
            currentRoute = 'products';
        } else if (pathWithoutLocale.match(/^\/(resep|recipe)\/[\w-]+$/)) {
            currentRoute = 'recipes';
        } else if (pathWithoutLocale.match(/^\/(lowongan|vacancy)\/[\w-]+$/)) {
            currentRoute = 'vacancies';
        }
    }

    // Apply active state to navigation items if a current route is identified
    if (currentRoute) {
        // Map of route names to their corresponding main navigation anchor elements
        const navLinks = {
            'company': document.getElementById('nav-company'),
            'brand': document.getElementById('nav-brand'),
            'products': document.getElementById('nav-products'),
            'recipes': document.getElementById('nav-recipes')
        };

        // Highlight the correct main navigation item
        if (navLinks[currentRoute]) {
            navLinks[currentRoute].classList.add('text-custom-lightgreen', 'active-nav-item');
            navLinks[currentRoute].classList.remove('text-white');
        }

        // Handle career dropdown highlighting separately as it's a special case
        if (currentRoute === 'careerinfo' || currentRoute === 'vacancies') {
            const careerDropdown = document.getElementById('career-dropdown');
            if (careerDropdown) {
                // Highlight the main 'Career' dropdown button
                careerDropdown.classList.add('text-custom-lightgreen', 'active-nav-item');
                careerDropdown.classList.remove('text-white');

                // Add active state to the parent group to keep the dropdown open (if needed by CSS)
                const parentGroup = careerDropdown.closest('.group');
                if (parentGroup) {
                    parentGroup.classList.add('active-dropdown');
                }

                // Highlight the specific item *within* the career dropdown
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

    // --- Mobile Menu Dropdown Functionality ---
    // This section handles the toggling of nested dropdowns within the mobile menu.
    // This part ensures that dropdowns like "Career" properly expand/collapse on mobile clicks.
    if (window.innerWidth <= 792) {
        const dropdownButtons = document.querySelectorAll('.group button');
        dropdownButtons.forEach(button => {
            // Only add listener if the button is a dropdown trigger, e.g., 'career-dropdown'
            if (button.id === 'career-dropdown' || button.id === 'dropdownHoverButton') { // Assuming these are the interactive dropdowns
                button.addEventListener('click', function(e) {
                    // Prevent default navigation if it's a link acting as a button
                    e.preventDefault();
                    const dropdownMenu = this.nextElementSibling; // The actual dropdown content (<ul> or <div>)
                    // Check if it's a dropdown menu (it should have 'group-hover:block' which is toggled)
                    if (dropdownMenu && dropdownMenu.classList.contains('group-hover:block')) {
                        dropdownMenu.classList.toggle('hidden'); // Toggle its visibility
                    }
                });
            }
        });
    }
});