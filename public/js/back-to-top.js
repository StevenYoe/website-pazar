// back-to-top.js
//
// This script controls the visibility and behavior of the 'Back to Top' button on the website.
// When the user scrolls down more than 20px, the button appears. Clicking the button smoothly scrolls the page to the top.

// Get the button element by its ID
const mybutton = document.getElementById("btn-back-to-top");

// Show or hide the button based on scroll position
const scrollFunction = () => {
  // If the user scrolls down more than 20px, show the button
  if (
    document.body.scrollTop > 20 ||
    document.documentElement.scrollTop > 20
  ) {
    mybutton.classList.remove("hidden");
  } else {
    // Otherwise, hide the button
    mybutton.classList.add("hidden");
  }
};

// Scroll smoothly to the top when the button is clicked
const backToTop = () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
};

// Add click event listener to the button
mybutton.addEventListener("click", backToTop);

// Add scroll event listener to window to toggle button visibility
window.addEventListener("scroll", scrollFunction);