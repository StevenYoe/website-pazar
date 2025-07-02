// vacancy-detail.js
//
// This script provides sharing and copy-to-clipboard functionality for the vacancy detail page.
// Each function is commented to clarify its purpose and logic for future maintainers.

// Share vacancy to social media platforms
function shareVacancy(platform) {
    const url = window.location.href; // Current page URL
    const title = document.querySelector('h1').innerText; // Vacancy title
    let shareUrl;
    // Build the share URL based on the selected platform
    switch (platform) {
        case 'facebook':
            shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
            break;
        case 'linkedin':
            shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
            break;
        case 'whatsapp':
            shareUrl = `https://api.whatsapp.com/send?text=${encodeURIComponent(title + ' - ' + url)}`;
            break;
        case 'twitter':
            shareUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`;
            break;
    }
    // Open the share dialog in a new window
    if (shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
}

// Copy the vacancy link to clipboard and show a tooltip
function copyVacancyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        const tooltip = document.querySelector('.link-copied-tooltip');
        tooltip.classList.add('visible');
        // Hide the tooltip after 2 seconds
        setTimeout(() => {
            tooltip.classList.remove('visible');
        }, 2000);
    });
}