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

    productItems.forEach(item => {
        const category = item.getAttribute('data-category') || '';
        const id = item.getAttribute('data-id') || '';
        const titleElement = item.querySelector('h3');
        const title = titleElement ? titleElement.textContent.trim() : 'Unknown';
    });

    filterButtons.forEach(button => {
        const filter = button.getAttribute('data-filter') || '';
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
            
            let visibleCount = 0;
            
            // Show/hide products based on filter
            productItems.forEach(item => {
                const itemCategory = (item.getAttribute('data-category') || '').trim();
                const titleElement = item.querySelector('h3');
                const itemTitle = titleElement ? titleElement.textContent.trim() : 'Unknown';
                
                // Show all items if 'all' is selected, else filter by category
                if (filterValue === 'all' || 
                   (filterValue !== '' && itemCategory !== '' && itemCategory === filterValue)) {
                    item.style.display = 'flex';  // Explicitly set to flex to ensure it displays
                    visibleCount++;
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

    // Download catalog functionality
    const downloadButtons = document.querySelectorAll('.download-catalog-btn');
    downloadButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add downloading class for visual feedback
            this.classList.add('downloading');
            
            // Show loading state
            const originalText = this.innerHTML;
            this.innerHTML = `
                <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Downloading...
            `;
            
            // Reset after 2 seconds
            setTimeout(() => {
                this.classList.remove('downloading');
                this.innerHTML = originalText;
                showDownloadNotification('Download started successfully!');
            }, 2000);
        });
    });
});

// Function to show download notification (optional)
function showDownloadNotification(message) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'download-notification';
    notification.innerHTML = `
        <div class="notification-content">
            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span>${message}</span>
        </div>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #10B981;
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        z-index: 1000;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    notification.querySelector('.notification-content').style.cssText = `
        display: flex;
        align-items: center;
        gap: 0.5rem;
    `;
    
    // Add to body
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}