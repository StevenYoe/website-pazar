// vacancy.js
//
// This script manages filtering and social sharing functionality for the vacancies page.
// Each section and function is commented to clarify its purpose and logic for future maintainers.

document.addEventListener('DOMContentLoaded', function() {
    // Filter elements for department and experience
    const departmentFilter = document.getElementById('department-filter');
    const experienceFilter = document.getElementById('experience-filter');
    const vacanciesContainer = document.getElementById('vacancies-container');
    const noResultsDiv = document.getElementById('no-results');
    
    // Initialize social share button functionality
    setupShareButtons();
    
    // Only proceed with filter functionality if all filters exist (vacancies page)
    if (departmentFilter && experienceFilter) {
        // Initial filter check in case filters are pre-selected
        filterVacancies();
        // Add event listeners to filters
        departmentFilter.addEventListener('change', filterVacancies);
        experienceFilter.addEventListener('change', filterVacancies);
    }
    
    // Filter vacancies based on selected filters
    function filterVacancies() {
        const selectedDepartment = departmentFilter.value;
        const selectedExperience = experienceFilter.value;
        let visibleCount = 0;
        // Get all vacancy items
        const vacancyItems = document.querySelectorAll('.vacancy-item');
        vacancyItems.forEach(function(item) {
            const departmentId = item.getAttribute('data-department');
            const experienceId = item.getAttribute('data-experience');
            // Check if item matches all selected filters or if 'all' is selected
            const departmentMatch = selectedDepartment === 'all' || departmentId === selectedDepartment;
            const experienceMatch = selectedExperience === 'all' || experienceId === selectedExperience;
            // Only show items that match all selected filters
            if (departmentMatch && experienceMatch) {
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
    
    // Set up social share buttons for vacancy detail page
    function setupShareButtons() {
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
    
    // Copy the current page URL to clipboard
    function copyToClipboard(text) {
        const input = document.createElement('input');
        input.style.position = 'fixed';
        input.style.opacity = 0;
        input.value = text;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
    }
    
    // Show a tooltip message when the link is copied
    function showCopiedMessage(button) {
        const tooltip = button.querySelector('.link-copied-tooltip');
        if (tooltip) {
            tooltip.classList.add('visible');
            setTimeout(() => {
                tooltip.classList.remove('visible');
            }, 2000);
        }
    }
});