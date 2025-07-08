// Product Search and Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('productSearch');
    const clearSearchBtn = document.getElementById('clearSearch');
    const productsGrid = document.getElementById('productsGrid');
    const noResults = document.getElementById('noResults');
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    let currentFilter = 'all';
    let currentSearchTerm = '';
    
    // Get current language from URL or Laravel localization
    const currentLocale = window.location.pathname.split('/')[1] || 'id';
    
    // Function to normalize text for search (remove accents, convert to lowercase)
    function normalizeText(text) {
        return text.toLowerCase()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .trim();
    }
    
    // Function to check if product matches search term
    function matchesSearch(product, searchTerm) {
        if (!searchTerm) return true;
        
        const normalizedSearch = normalizeText(searchTerm);
        
        // Get the appropriate text fields based on current language
        const titleField = currentLocale === 'en' ? 'data-title-en' : 'data-title-id';
        const descriptionField = currentLocale === 'en' ? 'data-description-en' : 'data-description-id';
        
        const title = normalizeText(product.getAttribute(titleField) || '');
        const description = normalizeText(product.getAttribute(descriptionField) || '');
        
        // Check if search term exists in title or description
        return title.includes(normalizedSearch) || description.includes(normalizedSearch);
    }
    
    // Function to check if product matches category filter
    function matchesCategory(product, categoryFilter) {
        if (categoryFilter === 'all') return true;
        
        const productCategory = product.getAttribute('data-category');
        return productCategory === categoryFilter;
    }
    
    // Function to filter and display products
    function filterProducts() {
        const products = document.querySelectorAll('.product-item');
        let visibleCount = 0;
        
        products.forEach(product => {
            const matchesSearchTerm = matchesSearch(product, currentSearchTerm);
            const matchesCategoryFilter = matchesCategory(product, currentFilter);
            
            if (matchesSearchTerm && matchesCategoryFilter) {
                product.style.display = 'flex';
                visibleCount++;
            } else {
                product.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
            productsGrid.classList.add('hidden');
        } else {
            noResults.classList.add('hidden');
            productsGrid.classList.remove('hidden');
        }
        
        // Update URL with search parameters (optional)
        updateURL();
    }
    
    // Function to update URL with current search and filter state
    function updateURL() {
        const url = new URL(window.location);
        
        if (currentSearchTerm) {
            url.searchParams.set('search', currentSearchTerm);
        } else {
            url.searchParams.delete('search');
        }
        
        if (currentFilter !== 'all') {
            url.searchParams.set('category', currentFilter);
        } else {
            url.searchParams.delete('category');
        }
        
        // Update URL without reloading page
        history.replaceState({}, '', url);
    }
    
    // Function to load search and filter from URL parameters
    function loadFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const searchParam = urlParams.get('search');
        const categoryParam = urlParams.get('category');
        
        if (searchParam) {
            currentSearchTerm = searchParam;
            searchInput.value = searchParam;
            toggleClearButton();
        }
        
        if (categoryParam) {
            currentFilter = categoryParam;
            // Update active filter button
            filterButtons.forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('data-filter') === categoryParam) {
                    btn.classList.add('active');
                }
            });
        }
        
        // Apply initial filter
        filterProducts();
    }
    
    // Function to toggle clear search button visibility
    function toggleClearButton() {
        if (searchInput.value.trim()) {
            clearSearchBtn.classList.remove('hidden');
        } else {
            clearSearchBtn.classList.add('hidden');
        }
    }
    
    // Search input event listener (live search)
    searchInput.addEventListener('input', function() {
        currentSearchTerm = this.value.trim();
        toggleClearButton();
        
        // Debounce search to avoid excessive filtering
        clearTimeout(searchInput.debounceTimer);
        searchInput.debounceTimer = setTimeout(() => {
            filterProducts();
        }, 300);
    });
    
    // Clear search button event listener
    clearSearchBtn.addEventListener('click', function() {
        searchInput.value = '';
        currentSearchTerm = '';
        toggleClearButton();
        filterProducts();
        searchInput.focus();
    });
    
    // Category filter button event listeners
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Update current filter
            currentFilter = this.getAttribute('data-filter');
            
            // Apply filter
            filterProducts();
        });
    });
    
    // Search input focus/blur events for better UX
    searchInput.addEventListener('focus', function() {
        this.parentElement.classList.add('ring-2', 'ring-custom-green');
    });
    
    searchInput.addEventListener('blur', function() {
        this.parentElement.classList.remove('ring-2', 'ring-custom-green');
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
        }
        
        // Escape to clear search when search input is focused
        if (e.key === 'Escape' && document.activeElement === searchInput) {
            if (currentSearchTerm) {
                searchInput.value = '';
                currentSearchTerm = '';
                toggleClearButton();
                filterProducts();
            } else {
                searchInput.blur();
            }
        }
    });
    
    // Initialize from URL parameters
    loadFromURL();
    
    // Handle browser back/forward buttons
    window.addEventListener('popstate', function() {
        loadFromURL();
    });
    
    // Add search hint for better UX
    const searchHint = document.createElement('div');
    searchHint.className = 'text-xs text-gray-500 mt-1 text-center';
    searchHint.innerHTML = currentLocale === 'en' 
        ? 'Press <kbd class="px-1 py-0.5 text-xs bg-gray-100 rounded">Ctrl+K</kbd> to focus search'
        : 'Tekan <kbd class="px-1 py-0.5 text-xs bg-gray-100 rounded">Ctrl+K</kbd> untuk fokus pencarian';
    
    searchInput.parentElement.parentElement.appendChild(searchHint);
    
    // Animation for product cards (optional enhancement)
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });
    
    // Observe all product cards for animation
    document.querySelectorAll('.product-item').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        observer.observe(card);
    });
});

// Additional utility functions for enhanced search
function highlightSearchTerms(text, searchTerm) {
    if (!searchTerm) return text;
    
    const regex = new RegExp(`(${searchTerm})`, 'gi');
    return text.replace(regex, '<mark class="bg-yellow-200 px-1 rounded">$1</mark>');
}

// Export for use in other scripts if needed
window.ProductSearch = {
    filterProducts: function() {
        // This allows external scripts to trigger filtering
        if (typeof filterProducts === 'function') {
            filterProducts();
        }
    }
};