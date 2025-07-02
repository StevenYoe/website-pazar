/**
 * card-height.js
 *
 * This script ensures that all cards within specified groups have equal heights for a consistent layout.
 * It dynamically calculates and sets the maximum height for cards, titles, and descriptions across each group.
 * The script runs on page load, window resize, and after all images are loaded to maintain visual consistency.
 *
 * Sections and logic are commented for clarity and maintainability.
 */
 
document.addEventListener('DOMContentLoaded', function() {
  // Function to equalize heights of card groups
  function equalizeCardHeights() {
    // Define selectors for card groups to equalize
    const cardGroups = [
      // Why Pazar cards
      '.why-pazar .grid > div',
      // Product Category cards 
      '.product-category .grid > div',
      // Products page cards
      '.product-section .grid > div',
      // Recipes page cards
      '.recipe-section .grid > div',
      // Vacancies page cards
      '.vacancies-item .grid > div'
    ];
    
    // Process each card group
    cardGroups.forEach(selector => {
      const cards = document.querySelectorAll(selector);
      if (cards.length <= 1) return; // Skip if only one card in group
      
      // Reset heights for accurate measurement
      cards.forEach(card => {
        card.style.height = 'auto';
        // Reset heights of titles inside cards
        const titles = card.querySelectorAll('h3, h4');
        titles.forEach(title => title.style.height = 'auto');
        // Reset heights of descriptions inside cards
        const descriptions = card.querySelectorAll('p:not(:last-child)');
        descriptions.forEach(desc => desc.style.height = 'auto');
      });
      
      // Find the maximum heights for cards, titles, and descriptions
      let maxCardHeight = 0;
      let maxTitleHeight = 0;
      let maxDescHeight = 0;
      
      cards.forEach(card => {
        // Get overall card height
        const cardHeight = card.offsetHeight;
        if (cardHeight > maxCardHeight) maxCardHeight = cardHeight;
        // Get title heights
        const titles = card.querySelectorAll('h3, h4');
        titles.forEach(title => {
          const titleHeight = title.offsetHeight;
          if (titleHeight > maxTitleHeight) maxTitleHeight = titleHeight;
        });
        // Get description heights
        const descriptions = card.querySelectorAll('p:not(:last-child)');
        descriptions.forEach(desc => {
          const descHeight = desc.offsetHeight;
          if (descHeight > maxDescHeight) maxDescHeight = descHeight;
        });
      });
      
      // Set all elements to the maximum heights found
      cards.forEach(card => {
        card.style.height = maxCardHeight + 'px';
        // Set title heights
        const titles = card.querySelectorAll('h3, h4');
        titles.forEach(title => title.style.height = maxTitleHeight + 'px');
        // Set description heights
        const descriptions = card.querySelectorAll('p:not(:last-child)');
        descriptions.forEach(desc => desc.style.height = maxDescHeight + 'px');
      });
    });
  }
  
  // Run equalization on page load
  equalizeCardHeights();
  
  // Run equalization when window is resized (debounced)
  let resizeTimer;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(equalizeCardHeights, 250);
  });
  
  // Run equalization when all images are loaded for accurate heights
  window.addEventListener('load', equalizeCardHeights);
});