// index.js
//
// This script controls the display of a popup modal on the homepage.
// The modal is shown automatically when the page loads and can be closed by clicking the close button.

document.addEventListener("DOMContentLoaded", function () {
    const popupModal = document.getElementById('popupModal'); // The modal element
    const closeModal = document.getElementById('closeModal'); // The close button

    // Show the modal when the page loads
    popupModal.classList.remove('hidden');

    // Hide the modal when the close button is clicked
    closeModal.addEventListener("click", function () {
        popupModal.classList.add('hidden');
    });
});