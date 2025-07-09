// Recipe Search and Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('recipeSearch');
    const clearSearchBtn = document.getElementById('clearSearch');
    const recipesGrid = document.querySelector('.grid');
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
    
    // Function to check if recipe matches search term
    function matchesSearch(recipe, searchTerm) {
        if (!searchTerm) return true;
        
        const normalizedSearch = normalizeText(searchTerm);
        
        // Get recipe title and category text
        const titleElement = recipe.querySelector('h3');
        const categoryElement = recipe.querySelector('h4');
        
        const title = normalizeText(titleElement ? titleElement.textContent : '');
        const category = normalizeText(categoryElement ? categoryElement.textContent : '');
        
        // Check if search term exists in title or category
        return title.includes(normalizedSearch) || category.includes(normalizedSearch);
    }
    
    // Function to check if recipe matches category filter
    function matchesCategory(recipe, categoryFilter) {
        if (categoryFilter === 'all') return true;
        
        const recipeCategory = recipe.getAttribute('data-category');
        const recipeCategories = JSON.parse(recipe.getAttribute('data-categories') || '[]');
        
        // Check if recipe belongs to selected category
        return recipeCategory === categoryFilter || recipeCategories.includes(categoryFilter);
    }
    
    // Function to filter and display recipes
    function filterRecipes() {
        const recipes = document.querySelectorAll('.recipe-item');
        let visibleCount = 0;
        
        recipes.forEach(recipe => {
            const matchesSearchTerm = matchesSearch(recipe, currentSearchTerm);
            const matchesCategoryFilter = matchesCategory(recipe, currentFilter);
            
            if (matchesSearchTerm && matchesCategoryFilter) {
                recipe.style.display = 'flex';
                visibleCount++;
            } else {
                recipe.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        if (visibleCount === 0) {
            if (noResults) {
                noResults.classList.remove('hidden');
            } else {
                // Create no results message if it doesn't exist
                createNoResultsMessage();
            }
            recipesGrid.style.display = 'none';
        } else {
            if (noResults) {
                noResults.classList.add('hidden');
            }
            recipesGrid.style.display = 'grid';
        }
        
        // Update URL with search parameters
        updateURL();
    }
    
    // Function to create no results message
    function createNoResultsMessage() {
        const noResultsDiv = document.createElement('div');
        noResultsDiv.id = 'noResults';
        noResultsDiv.className = 'text-center py-10 col-span-full';
        noResultsDiv.innerHTML = `
            <p class="text-lg text-gray-500">
                ${currentLocale === 'en' ? 'No recipes found matching your search.' : 'Tidak ada resep yang ditemukan sesuai pencarian Anda.'}
            </p>
        `;
        recipesGrid.parentNode.insertBefore(noResultsDiv, recipesGrid);
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
        
        if (searchParam && searchInput) {
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
        filterRecipes();
    }
    
    // Function to toggle clear search button visibility
    function toggleClearButton() {
        if (searchInput && clearSearchBtn) {
            if (searchInput.value.trim()) {
                clearSearchBtn.classList.remove('hidden');
            } else {
                clearSearchBtn.classList.add('hidden');
            }
        }
    }
    
    // Search input event listener (live search)
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            currentSearchTerm = this.value.trim();
            toggleClearButton();
            
            // Debounce search to avoid excessive filtering
            clearTimeout(searchInput.debounceTimer);
            searchInput.debounceTimer = setTimeout(() => {
                filterRecipes();
            }, 300);
        });
        
        // Search input focus/blur events for better UX
        searchInput.addEventListener('focus', function() {
            this.parentElement.classList.add('ring-2', 'ring-custom-green');
        });
        
        searchInput.addEventListener('blur', function() {
            this.parentElement.classList.remove('ring-2', 'ring-custom-green');
        });
    }
    
    // Clear search button event listener
    if (clearSearchBtn) {
        clearSearchBtn.addEventListener('click', function() {
            searchInput.value = '';
            currentSearchTerm = '';
            toggleClearButton();
            filterRecipes();
            searchInput.focus();
        });
    }
    
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
            filterRecipes();
        });
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k' && searchInput) {
            e.preventDefault();
            searchInput.focus();
        }
        
        // Escape to clear search when search input is focused
        if (e.key === 'Escape' && document.activeElement === searchInput) {
            if (currentSearchTerm) {
                searchInput.value = '';
                currentSearchTerm = '';
                toggleClearButton();
                filterRecipes();
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
    
    // Animation for recipe cards
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });
    
    // Observe all recipe cards for animation
    document.querySelectorAll('.recipe-item').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        observer.observe(card);
    });
});

// Export for use in other scripts if needed
window.RecipeSearch = {
    filterRecipes: function() {
        // This allows external scripts to trigger filtering
        if (typeof filterRecipes === 'function') {
            filterRecipes();
        }
    }
};