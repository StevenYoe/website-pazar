// Testimonial tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const customerBtn = document.getElementById('customerTabBtn');
    const chefBtn = document.getElementById('chefTabBtn');
    const customerContent = document.getElementById('customerTestimonials');
    const chefContent = document.getElementById('chefTestimonials');
    
    customerBtn.addEventListener('click', function() {
        // Update button styles
        customerBtn.classList.add('testimonial-tab-active');
        customerBtn.classList.remove('testimonial-tab');
        chefBtn.classList.add('testimonial-tab');
        chefBtn.classList.remove('testimonial-tab-active');
        
        // Show/hide content
        customerContent.classList.remove('hidden');
        chefContent.classList.add('hidden');
    });
    
    chefBtn.addEventListener('click', function() {
        // Update button styles
        chefBtn.classList.add('testimonial-tab-active');
        chefBtn.classList.remove('testimonial-tab');
        customerBtn.classList.add('testimonial-tab');
        customerBtn.classList.remove('testimonial-tab-active');
        
        // Show/hide content
        chefContent.classList.remove('hidden');
        customerContent.classList.add('hidden');
    });
});

// Image popup functionality
function openImagePopup(imageSrc, customerName) {
    const modal = document.getElementById('imagePopupModal');
    const popupImage = document.getElementById('popupImage');
    const popupCaption = document.getElementById('popupImageCaption');
    
    // Set the image source and caption
    popupImage.src = imageSrc;
    popupImage.alt = customerName + ' testimonial image';
    popupCaption.textContent = customerName + ' - Customer Testimonial';
    
    // Show the modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden'; // Prevent background scrolling
    
    // Add click outside to close functionality
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeImagePopup();
        }
    });
}

function closeImagePopup() {
    const modal = document.getElementById('imagePopupModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto'; // Restore scrolling
}

// Close popup with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImagePopup();
    }
});

// Prevent image drag
document.addEventListener('DOMContentLoaded', function() {
    const popupImage = document.getElementById('popupImage');
    if (popupImage) {
        popupImage.addEventListener('dragstart', function(e) {
            e.preventDefault();
        });
    }
});