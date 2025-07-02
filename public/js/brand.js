// brand.js
//
// This script manages testimonial tab switching and image popup functionality on the brand page.
// Comments are provided for each section to help programmers understand the logic and flow.

// Testimonial tab functionality: toggles between customer and chef testimonials
// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    const customerBtn = document.getElementById('customerTabBtn'); // Button for customer testimonials
    const chefBtn = document.getElementById('chefTabBtn');         // Button for chef testimonials
    const customerContent = document.getElementById('customerTestimonials'); // Customer testimonials content
    const chefContent = document.getElementById('chefTestimonials');         // Chef testimonials content
    
    // When customer tab is clicked, activate customer tab and show customer testimonials
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
    
    // When chef tab is clicked, activate chef tab and show chef testimonials
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

// Image popup functionality: opens a modal with a larger testimonial image and caption
function openImagePopup(imageSrc, customerName) {
    const modal = document.getElementById('imagePopupModal');
    const popupImage = document.getElementById('popupImage');
    const popupCaption = document.getElementById('popupImageCaption');
    
    // Set the image source and caption
    popupImage.src = imageSrc;
    popupImage.alt = customerName + ' testimonial image';
    popupCaption.textContent = customerName + ' - Customer Testimonial';
    
    // Show the modal and prevent background scrolling
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Allow closing the modal by clicking outside the image
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeImagePopup();
        }
    });
}

// Closes the image popup modal and restores scrolling
function closeImagePopup() {
    const modal = document.getElementById('imagePopupModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close popup with Escape key for accessibility
// Listens for Escape key to close the image popup
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImagePopup();
    }
});

// Prevent image drag: disables dragging of the popup image for better UX
// Wait for DOMContentLoaded to ensure the image exists
document.addEventListener('DOMContentLoaded', function() {
    const popupImage = document.getElementById('popupImage');
    if (popupImage) {
        popupImage.addEventListener('dragstart', function(e) {
            e.preventDefault();
        });
    }
});