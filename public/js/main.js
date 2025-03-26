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

document.addEventListener("DOMContentLoaded", function () {
    const popupModal = document.getElementById('popupModal');
    const closeModal = document.getElementById('closeModal');

    // Tampilkan modal saat halaman dimuat
    popupModal.classList.remove('hidden');

    // Sembunyikan modal saat tombol close diklik
    closeModal.addEventListener("click", function () {
        popupModal.classList.add('hidden');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const currentPage = document.body.getAttribute('data-page'); // Ambil nama rute dari data-page
    
    // Navigation configuration
    const navigationConfig = {
        'products': {
            dropdownId: 'about-dropdown',
            activeIds: ['about-products']
        },
        'company': {
            dropdownId: 'about-dropdown',
            activeIds: ['about-company']
        },
        'history': {
            dropdownId: 'about-dropdown', 
            activeIds: ['about-pazar']
        },
        'careerinfo': {
            dropdownId: 'career-dropdown',
            activeIds: ['career-info']
        },
        'vacancies': {
            dropdownId: 'career-dropdown',
            activeIds: ['career-vacancies']
        }
    };

    const config = navigationConfig[currentPage];

    if (config) {
        const dropdownButton = document.getElementById(config.dropdownId);
        if (dropdownButton) {
            dropdownButton.classList.add('text-custom-lightgreen');
            
            const parentGroup = dropdownButton.closest('.group');
            if (parentGroup) {
                parentGroup.classList.add('active-dropdown');
            }
        }
        
        config.activeIds.forEach(id => {
            const link = document.getElementById(id);
            if (link) {
                link.classList.add('bg-custom-lightergreen', 'text-white');
            }
        });
    }
});
