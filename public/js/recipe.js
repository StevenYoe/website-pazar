// Recipe filter functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get all filter buttons and recipe items
    const filterButtons = document.querySelectorAll('.filter-btn');
    const recipeItems = document.querySelectorAll('.recipe-item');

    // Check if elements exist before proceeding
    if (filterButtons.length === 0) {
        console.warn('No filter buttons found on this page');
        return; // Exit if no filter buttons
    }
    
    if (recipeItems.length === 0) {
        console.warn('No recipe items found on this page');
        return; // Exit if no recipe items
    }

    // Debug: Log all recipe items and their categories
    recipeItems.forEach(item => {
        const category = item.getAttribute('data-category') || '';
        const categories = item.getAttribute('data-categories') ? 
            JSON.parse(item.getAttribute('data-categories')) : [];
        const id = item.getAttribute('data-id') || '';
        const titleElement = item.querySelector('h3');
        const title = titleElement ? titleElement.textContent.trim() : 'Unknown';
        
        console.log(`Recipe: ${title} (ID: ${id}), Primary Category: ${category}, All Categories:`, categories);
    });

    // Add click event listeners to filter buttons
    filterButtons.forEach(button => {
    button.addEventListener('click', function() {
        // Remove 'active' class from all buttons
        filterButtons.forEach(btn => btn.classList.remove('active'));
        // Add 'active' class to clicked button
        this.classList.add('active');
        // Get filter value
        const filterValue = this.getAttribute('data-filter') || '';
        
        // Show/hide recipes based on filter
        recipeItems.forEach(item => {
        const itemCategory = (item.getAttribute('data-category') || '').trim();
        const itemCategories = item.getAttribute('data-categories') ? 
            JSON.parse(item.getAttribute('data-categories')) : [];
        
        // Show all items if 'all' is selected, or if the category matches
        if (filterValue === 'all' || 
            (filterValue !== '' && (
                itemCategory === filterValue ||
                itemCategories.includes(filterValue)
            ))) {
            item.style.display = 'flex';
        } else {
            item.style.display = 'none';
        }
        });
    });
    });

    // Initially activate the "All" filter
    const allFilterBtn = document.querySelector('.filter-btn[data-filter="all"]');
    if (allFilterBtn) {
        allFilterBtn.click();
    } else {
        console.warn("Couldn't find 'All' filter button");
        // If there's no "All" button, activate the first filter instead
        if (filterButtons.length > 0) {
            filterButtons[0].click();
        }
    }
});