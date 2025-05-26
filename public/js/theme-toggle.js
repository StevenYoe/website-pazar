// Theme Toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    // Function to detect system theme preference
    function getSystemTheme() {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            return 'dark';
        }
        return 'light';
    }

    // Function to get theme from cookie or system preference
    function getThemePreference() {
        let cookies = document.cookie.split('; ');
        for (let cookie of cookies) {
            let [name, value] = cookie.split('=');
            if (name === 'theme') {
                return value;
            }
        }
        // If no cookie found, use system preference
        return getSystemTheme();
    }

    // Function to apply theme
    function applyTheme(theme) {
        const html = document.documentElement;
        const body = document.body;
        
        if (theme === 'dark') {
            html.classList.add('dark');
            body.setAttribute('data-theme', 'dark');
        } else {
            html.classList.remove('dark');
            body.setAttribute('data-theme', 'light');
        }

        // Update theme toggle button text/icon
        updateThemeToggleButton(theme);
        
        // Update global theme variable if exists
        if (window.currentTheme !== undefined) {
            window.currentTheme = theme;
        }
    }

    // Function to update theme toggle button
    function updateThemeToggleButton(theme) {
        const themeToggleBtn = document.querySelector('#theme-toggle-btn');
        if (themeToggleBtn) {
            const lightModeIcon = themeToggleBtn.querySelector('.light-mode-content');
            const darkModeIcon = themeToggleBtn.querySelector('.dark-mode-content');
            
            if (theme === 'dark') {
                if (lightModeIcon) lightModeIcon.style.display = 'flex';
                if (darkModeIcon) darkModeIcon.style.display = 'none';
            } else {
                if (lightModeIcon) lightModeIcon.style.display = 'none';
                if (darkModeIcon) darkModeIcon.style.display = 'flex';
            }
        }
    }

    // Function to set cookie
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    // Initialize theme on page load
    const initialTheme = getThemePreference();
    applyTheme(initialTheme);

    // Listen for system theme changes
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
            // Only apply system theme if user hasn't manually set a preference
            let cookies = document.cookie.split('; ');
            let hasThemeCookie = false;
            for (let cookie of cookies) {
                let [name] = cookie.split('=');
                if (name === 'theme') {
                    hasThemeCookie = true;
                    break;
                }
            }
            
            if (!hasThemeCookie) {
                const systemTheme = e.matches ? 'dark' : 'light';
                applyTheme(systemTheme);
            }
        });
    }

    // Theme toggle functionality
    function toggleTheme() {
        const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        // Apply theme immediately
        applyTheme(newTheme);
        
        // Set cookie
        setCookie('theme', newTheme, 365); // 1 year
        
        // Optional: Make AJAX call to server to sync
        fetch('/theme/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({ theme: newTheme })
        }).catch(err => {
            console.log('Theme toggle sync error:', err);
            // Don't worry if server sync fails, client-side theme is already applied
        });
    }

    // Attach toggle function to theme toggle buttons
    const themeToggleLinks = document.querySelectorAll('a[href*="theme/toggle"], #theme-toggle-btn');
    themeToggleLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            toggleTheme();
        });
    });

    // Make toggleTheme globally available
    window.toggleTheme = toggleTheme;
});