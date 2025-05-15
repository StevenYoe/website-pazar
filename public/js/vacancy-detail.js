// Share vacancy functions
function shareVacancy(platform) {
    const url = window.location.href;
    const title = document.querySelector('h1').innerText;
    let shareUrl;
    
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
    
    if (shareUrl) {
        window.open(shareUrl, '_blank', 'width=600,height=400');
    }
}

// Copy vacancy link to clipboard
function copyVacancyLink() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(() => {
        const tooltip = document.querySelector('.link-copied-tooltip');
        tooltip.classList.add('visible');
        
        setTimeout(() => {
            tooltip.classList.remove('visible');
        }, 2000);
    });
}