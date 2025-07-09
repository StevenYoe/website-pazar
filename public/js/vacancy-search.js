// Vacancy Search and Filter Functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('vacancySearch');
    const clearSearchBtn = document.getElementById('clearSearch');
    const vacanciesContainer = document.getElementById('vacancies-container');
    const noResults = document.getElementById('no-results');
    const departmentFilter = document.getElementById('department-filter');
    const experienceFilter = document.getElementById('experience-filter');
    
    let currentDepartmentFilter = 'all';
    let currentExperienceFilter = 'all';
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
    
    // Function to check if vacancy matches search term
    function matchesSearch(vacancy, searchTerm) {
        if (!searchTerm) return true;
        
        const normalizedSearch = normalizeText(searchTerm);
        
        // Get vacancy title and department text
        const titleElement = vacancy.querySelector('h3');
        const departmentElement = vacancy.querySelector('.flex .items-center span');
        
        const title = normalizeText(titleElement ? titleElement.textContent : '');
        const department = normalizeText(departmentElement ? departmentElement.textContent : '');
        
        // Check if search term exists in title or department
        return title.includes(normalizedSearch) || department.includes(normalizedSearch);
    }
    
    // Function to check if vacancy matches department filter
    function matchesDepartment(vacancy, departmentFilter) {
        if (departmentFilter === 'all') return true;
        
        const vacancyDepartment = vacancy.getAttribute('data-department');
        return vacancyDepartment === departmentFilter;
    }
    
    // Function to check if vacancy matches experience filter
    function matchesExperience(vacancy, experienceFilter) {
        if (experienceFilter === 'all') return true;
        
        const vacancyExperience = vacancy.getAttribute('data-experience');
        return vacancyExperience === experienceFilter;
    }
    
    // Function to filter and display vacancies
    function filterVacancies() {
        const vacancies = document.querySelectorAll('.vacancy-item');
        let visibleCount = 0;
        
        vacancies.forEach(vacancy => {
            const matchesSearchTerm = matchesSearch(vacancy, currentSearchTerm);
            const matchesDepartmentFilter = matchesDepartment(vacancy, currentDepartmentFilter);
            const matchesExperienceFilter = matchesExperience(vacancy, currentExperienceFilter);
            
            if (matchesSearchTerm && matchesDepartmentFilter && matchesExperienceFilter) {
                vacancy.style.display = 'flex';
                visibleCount++;
            } else {
                vacancy.style.display = 'none';
            }
        });
        
        // Show/hide no results message
        if (visibleCount === 0) {
            if (noResults) {
                noResults.classList.remove('hidden');
            }
            vacanciesContainer.style.display = 'none';
        } else {
            if (noResults) {
                noResults.classList.add('hidden');
            }
            vacanciesContainer.style.display = 'grid';
        }
        
        // Update URL with search parameters
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
        
        if (currentDepartmentFilter !== 'all') {
            url.searchParams.set('department', currentDepartmentFilter);
        } else {
            url.searchParams.delete('department');
        }
        
        if (currentExperienceFilter !== 'all') {
            url.searchParams.set('experience', currentExperienceFilter);
        } else {
            url.searchParams.delete('experience');
        }
        
        // Update URL without reloading page
        history.replaceState({}, '', url);
    }
    
    // Function to load search and filter from URL parameters
    function loadFromURL() {
        const urlParams = new URLSearchParams(window.location.search);
        const searchParam = urlParams.get('search');
        const departmentParam = urlParams.get('department');
        const experienceParam = urlParams.get('experience');
        
        if (searchParam && searchInput) {
            currentSearchTerm = searchParam;
            searchInput.value = searchParam;
            toggleClearButton();
        }
        
        if (departmentParam && departmentFilter) {
            currentDepartmentFilter = departmentParam;
            departmentFilter.value = departmentParam;
        }
        
        if (experienceParam && experienceFilter) {
            currentExperienceFilter = experienceParam;
            experienceFilter.value = experienceParam;
        }
        
        // Apply initial filter
        filterVacancies();
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
                filterVacancies();
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
            filterVacancies();
            searchInput.focus();
        });
    }
    
    // Department filter event listener
    if (departmentFilter) {
        departmentFilter.addEventListener('change', function() {
            currentDepartmentFilter = this.value;
            filterVacancies();
        });
    }
    
    // Experience filter event listener
    if (experienceFilter) {
        experienceFilter.addEventListener('change', function() {
            currentExperienceFilter = this.value;
            filterVacancies();
        });
    }
    
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
                filterVacancies();
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
    
    // Animation for vacancy cards
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    });
    
    // Observe all vacancy cards for animation
    document.querySelectorAll('.vacancy-item').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        observer.observe(card);
    });
});

// Export for use in other scripts if needed
window.VacancySearch = {
    filterVacancies: function() {
        // This allows external scripts to trigger filtering
        if (typeof filterVacancies === 'function') {
            filterVacancies();
        }
    }
};