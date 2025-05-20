/**
 * improved-card-height.js
 * Enhanced script to maintain equal card heights without truncating content
 */
 
document.addEventListener('DOMContentLoaded', function() {
  // Function to equalize heights of card groups
  function equalizeCardHeights() {
    // Define card groups to equalize
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
      if (cards.length <= 1) return; // Skip if only one card
      
      // Reset heights first for accurate measurement
      cards.forEach(card => {
        card.style.height = 'auto';
        
        // Reset heights of specific elements inside cards
        const titles = card.querySelectorAll('h3, h4');
        titles.forEach(title => title.style.height = 'auto');
        
        const descriptions = card.querySelectorAll('p:not(:last-child)');
        descriptions.forEach(desc => desc.style.height = 'auto');
      });
      
      // Determine largest heights by element type
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
      
      // Set all elements to maximum heights
      cards.forEach(card => {
        // Set overall card height
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
  
  // Run on page load
  equalizeCardHeights();
  
  // Run when window is resized
  let resizeTimer;
  window.addEventListener('resize', function() {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(equalizeCardHeights, 250);
  });
  
  // Run when images are loaded to get accurate heights
  window.addEventListener('load', equalizeCardHeights);
});