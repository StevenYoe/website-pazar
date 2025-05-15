// Vacancy Filter and Sharing Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality for vacancies
    const departmentFilter = document.getElementById('department-filter');
    const employmentFilter = document.getElementById('employment-filter');
    const experienceFilter = document.getElementById('experience-filter');
    const vacanciesContainer = document.getElementById('vacancies-container');
    const noResultsDiv = document.getElementById('no-results');
    
    // Social Share functionality
    setupShareButtons();
    
    // Only proceed with filter functionality if we're on the vacancies page
    if (departmentFilter && employmentFilter && experienceFilter) {
        // Initial check in case page loads with pre-selected filters
        filterVacancies();
        
        // Add event listeners to filters
        departmentFilter.addEventListener('change', filterVacancies);
        employmentFilter.addEventListener('change', filterVacancies);
        experienceFilter.addEventListener('change', filterVacancies);
    }
    
    function filterVacancies() {
        const selectedDepartment = departmentFilter.value;
        const selectedEmployment = employmentFilter.value;
        const selectedExperience = experienceFilter.value;
        
        let visibleCount = 0;
        
        // Get all vacancy items
        const vacancyItems = document.querySelectorAll('.vacancy-item');
        
        vacancyItems.forEach(function(item) {
            const departmentId = item.getAttribute('data-department');
            const employmentId = item.getAttribute('data-employment');
            const experienceId = item.getAttribute('data-experience');
            
            // Check if item matches all selected filters or if 'all' is selected for that filter
            const departmentMatch = selectedDepartment === 'all' || departmentId === selectedDepartment;
            const employmentMatch = selectedEmployment === 'all' || employmentId === selectedEmployment;
            const experienceMatch = selectedExperience === 'all' || experienceId === selectedExperience;
            
            // Only show items that match all selected filters
            if (departmentMatch && employmentMatch && experienceMatch) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });
        
        // Show or hide the no results message
        if (vacancyItems.length > 0 && visibleCount === 0) {
            if (noResultsDiv) {
                noResultsDiv.style.display = 'block';
                noResultsDiv.classList.remove('hidden');
            }
        } else {
            if (noResultsDiv) {
                noResultsDiv.style.display = 'none';
                noResultsDiv.classList.add('hidden');
            }
        }
    }
    
    function setupShareButtons() {
        // Check if we're on the vacancy detail page
        const shareButtons = document.querySelectorAll('.share-btn');
        if (shareButtons.length === 0) return;
        
        shareButtons.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                
                const platform = this.getAttribute('data-platform');
                const url = window.location.href;
                const title = document.title;
                
                let shareUrl;
                
                switch(platform) {
                    case 'facebook':
                        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
                        break;
                    case 'linkedin':
                        shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
                        break;
                    case 'twitter':
                        shareUrl = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
                        break;
                    case 'whatsapp':
                        shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(title + ' ' + url)}`;
                        break;
                    case 'copy':
                        copyToClipboard(url);
                        showCopiedMessage(this);
                        return;
                }
                
                // Open share dialog in a new window
                if (shareUrl) {
                    window.open(shareUrl, '_blank', 'width=600,height=400');
                }
            });
        });
    }
    
    function copyToClipboard(text) {
        // Create a temporary input element
        const input = document.createElement('input');
        input.style.position = 'fixed';
        input.style.opacity = 0;
        input.value = text;
        document.body.appendChild(input);
        
        // Select and copy the text
        input.select();
        document.execCommand('copy');
        
        // Clean up
        document.body.removeChild(input);
    }
    
    function showCopiedMessage(button) {
        // Find the tooltip element within the button
        const tooltip = button.querySelector('.link-copied-tooltip');
        if (tooltip) {
            tooltip.classList.add('visible');
            
            // Hide the tooltip after 2 seconds
            setTimeout(() => {
                tooltip.classList.remove('visible');
            }, 2000);
        }
    }
});