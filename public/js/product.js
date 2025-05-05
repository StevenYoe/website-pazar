// Product filter functionality
document.addEventListener('DOMContentLoaded', function() {
    // Get all filter buttons and product items
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productItems = document.querySelectorAll('.product-item');

    // Check if elements exist before proceeding
    if (filterButtons.length === 0) {
        console.warn('No filter buttons found on this page');
        return; // Exit if no filter buttons
    }
    
    if (productItems.length === 0) {
        console.warn('No product items found on this page');
        return; // Exit if no product items
    }

    console.log(`Found ${filterButtons.length} filter buttons and ${productItems.length} product items`);

    // Add click event listeners to filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove 'active' class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            
            // Add 'active' class to clicked button
            this.classList.add('active');
            
            // Get filter value
            const filterValue = this.getAttribute('data-filter');
            
            console.log(`Filter selected: ${filterValue}`);
            
            let visibleCount = 0;
            
            // Show/hide products based on filter
            productItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category');
                
                // Show all items if 'all' is selected, else filter by category
                if (filterValue === 'all' || itemCategory === filterValue) {
                    item.style.display = 'flex';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            console.log(`Showing ${visibleCount} products for filter: ${filterValue}`);
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