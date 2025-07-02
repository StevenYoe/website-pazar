// history-carousel.js
//
// This script implements a custom carousel for the history/timeline section.
// It supports navigation, custom indicators, and touch/mouse drag for slide navigation.
// Each section and function is commented to clarify its purpose and logic for future maintainers.

document.addEventListener('DOMContentLoaded', function() {
    // Get carousel elements
    const track = document.getElementById('historyTrack'); // The container for carousel items
    const items = document.querySelectorAll('.history-item'); // All carousel items
    const nextButton = document.querySelector('.history-carousel-next'); // Next navigation button
    const prevButton = document.querySelector('.history-carousel-prev'); // Previous navigation button
    const indicatorsContainer = document.querySelector('.history-carousel-indicators'); // Indicator dots container
    
    let itemsPerSlide = 1; // Only one item per slide for history carousel
    let maxIndex = items.length - 1; // Maximum slide index
    // Start at the last slide (most recent history)
    let currentIndex = maxIndex;
    
    // Touch/drag state variables
    let isDragging = false;
    let startPos = 0;
    let currentTranslate = 0;
    let prevTranslate = 0;
    let animationID = 0;
    
    // Set cursor style for draggable track
    track.style.cursor = 'grab';
    
    // Create indicator dots (logo for active, gray for inactive)
    function createIndicators() {
        indicatorsContainer.innerHTML = '';
        for (let i = 0; i <= maxIndex; i++) {
            const button = document.createElement('button');
            button.classList.add('h-6', 'w-6', 'mx-2', 'transition-all', 'duration-300');
            if (i === currentIndex) {
                // Use the logo for active indicator
                const img = document.createElement('img');
                img.src = '/img/Web/Logo.webp';
                img.alt = 'Active page';
                img.classList.add('w-full', 'h-full', 'object-contain');
                button.appendChild(img);
                button.classList.add('scale-125');
            } else {
                button.classList.add('bg-gray-300', 'rounded-full');
            }
            button.setAttribute('data-index', i);
            button.setAttribute('aria-label', `Go to slide ${i+1}`);
            // Jump to slide on indicator click
            button.addEventListener('click', function() {
                currentIndex = i;
                updateCarousel();
            });
            indicatorsContainer.appendChild(button);
        }
    }
    
    // Update carousel position and indicator states
    function updateCarousel() {
        const itemWidth = 100;
        const offset = currentIndex * itemWidth;
        track.style.transform = `translateX(-${offset}%)`;
        // Update indicator visuals
        const indicators = document.querySelectorAll('.history-carousel-indicators button');
        indicators.forEach((indicator, index) => {
            indicator.innerHTML = '';
            indicator.classList.remove('bg-gray-300', 'rounded-full', 'scale-125');
            if (index === currentIndex) {
                // Use the logo for active indicator
                const img = document.createElement('img');
                img.src = '/img/Web/Logo.webp';
                img.alt = 'Active page';
                img.classList.add('w-full', 'h-full', 'object-contain');
                indicator.appendChild(img);
                indicator.classList.add('scale-125');
            } else {
                indicator.classList.add('bg-gray-300', 'rounded-full');
            }
        });
    }
    
    // Set up item widths for carousel layout
    items.forEach(item => {
        item.style.flex = `0 0 ${100 / itemsPerSlide}%`;
    });
    
    // Next button: go to next slide
    nextButton.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % (maxIndex + 1);
        updateCarousel();
    });
    
    // Previous button: go to previous slide
    prevButton.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + maxIndex + 1) % (maxIndex + 1);
        updateCarousel();
    });
    
    // Touch and mouse drag/swipe support for carousel navigation
    track.addEventListener('touchstart', touchStart);
    track.addEventListener('touchmove', touchMove);
    track.addEventListener('touchend', touchEnd);
    track.addEventListener('mousedown', touchStart);
    window.addEventListener('mousemove', touchMove);
    window.addEventListener('mouseup', touchEnd);
    // Prevent context menu on right-click during drag
    track.addEventListener('contextmenu', e => {
        e.preventDefault();
        e.stopPropagation();
    });
    
    // Start drag/swipe
    function touchStart(event) {
        startPos = getPositionX(event);
        isDragging = true;
        track.style.cursor = 'grabbing';
        track.style.userSelect = 'none';
        animationID = requestAnimationFrame(animation);
        if (event.type === 'mousedown') {
            event.preventDefault();
        }
    }
    // Handle drag/swipe movement
    function touchMove(event) {
        if (isDragging) {
            const currentPosition = getPositionX(event);
            currentTranslate = prevTranslate + currentPosition - startPos;
            if (event.type === 'mousemove') {
                event.preventDefault();
            }
        }
    }
    // End drag/swipe and determine if slide should change
    function touchEnd() {
        cancelAnimationFrame(animationID);
        if (isDragging) {
            track.style.cursor = 'grab';
            const threshold = 15; // Minimum percent to trigger slide change
            const container = document.querySelector('.history-carousel-container');
            const containerWidth = container.offsetWidth;
            const movedPercentage = (Math.abs(currentTranslate - prevTranslate) / containerWidth) * 100;
            if (movedPercentage > threshold) {
                if (currentTranslate < prevTranslate) {
                    currentIndex = Math.min(currentIndex + 1, maxIndex);
                } else {
                    currentIndex = Math.max(currentIndex - 1, 0);
                }
            }
            isDragging = false;
            updateCarousel();
            prevTranslate = 0;
            currentTranslate = 0;
        }
    }
    // Get X position from mouse or touch event
    function getPositionX(event) {
        return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
    }
    // Animation loop for smooth dragging
    function animation() {
        if (isDragging) {
            const slideWidth = 100;
            // Set limits for dragging based on current index
            let minTranslate = -slideWidth;
            let maxAllowedTranslate = slideWidth;
            // Adjust translation bounds for edge cases
            if (currentIndex === 0) {
                minTranslate = 0;
            }
            if (currentIndex === maxIndex) {
                maxAllowedTranslate = 0;
            }
            // Limit drag amount
            if (currentTranslate > maxAllowedTranslate) {
                currentTranslate = maxAllowedTranslate;
            } else if (currentTranslate < minTranslate) {
                currentTranslate = minTranslate;
            }
            const baseTranslate = -(currentIndex * slideWidth);
            track.style.transform = `translateX(${baseTranslate + currentTranslate}%)`;
            requestAnimationFrame(animation);
        }
    }
    // Initialize carousel on page load
    createIndicators();
    updateCarousel();
});