// carousel.js
//
// This script implements a responsive, touch-enabled carousel for certification items.
// It supports auto-advance, manual navigation, swipe/drag gestures, and dynamic indicators.
// Each section and function is commented to clarify its purpose and logic for future maintainers.

document.addEventListener('DOMContentLoaded', function() {
    // Get carousel elements
    const track = document.getElementById('certificationTrack'); // The container for carousel items
    const items = document.querySelectorAll('.certification-item'); // All carousel items
    const nextButton = document.querySelector('.carousel-next'); // Next navigation button
    const prevButton = document.querySelector('.carousel-prev'); // Previous navigation button
    const indicatorsContainer = document.querySelector('.carousel-indicators'); // Indicator dots container
    
    let currentIndex = 0; // Current slide index
    let itemsPerSlide = window.innerWidth >= 793 ? 2 : 1; // Number of items per slide (responsive)
    let maxIndex = Math.ceil(items.length / itemsPerSlide) - 1; // Maximum slide index
    let autoAdvance = null; // Interval for auto-advancing the carousel
    
    // Touch/drag state variables
    let isDragging = false;
    let startPos = 0;
    let currentTranslate = 0;
    let prevTranslate = 0;
    let animationID = 0;
    
    // Set cursor style for draggable track
    track.style.cursor = 'grab';
    
    // Create indicator dots based on number of slides
    function createIndicators() {
        indicatorsContainer.innerHTML = '';
        for (let i = 0; i <= maxIndex; i++) {
            const button = document.createElement('button');
            button.classList.add('h-2', 'w-2', 'rounded-full', 'mx-1');
            // Highlight the active indicator
            if (i === currentIndex) {
                button.classList.add('bg-custom-green');
            } else {
                button.classList.add('bg-gray-300');
            }
            // Jump to slide on indicator click
            button.addEventListener('click', function() {
                currentIndex = i;
                updateCarousel();
                resetAutoAdvance();
            });
            indicatorsContainer.appendChild(button);
        }
    }
    
    // Update carousel position and indicator states
    function updateCarousel() {
        const itemWidth = 100 / itemsPerSlide;
        const offset = currentIndex * itemWidth * itemsPerSlide;
        track.style.transform = `translateX(-${offset}%)`;
        // Update indicator colors
        const indicators = document.querySelectorAll('.carousel-indicators button');
        indicators.forEach((indicator, index) => {
            if (index === currentIndex) {
                indicator.classList.remove('bg-gray-300');
                indicator.classList.add('bg-custom-green');
            } else {
                indicator.classList.remove('bg-custom-green');
                indicator.classList.add('bg-gray-300');
            }
        });
    }
    
    // Reset and start auto-advance interval
    function resetAutoAdvance() {
        if (autoAdvance) {
            clearInterval(autoAdvance);
        }
        autoAdvance = setInterval(function() {
            currentIndex = (currentIndex + 1) % (maxIndex + 1);
            updateCarousel();
        }, 5000);
    }
    
    // Responsive: update carousel on window resize
    window.addEventListener('resize', function() {
        const oldItemsPerSlide = itemsPerSlide;
        itemsPerSlide = window.innerWidth >= 793 ? 2 : 1;
        if (oldItemsPerSlide !== itemsPerSlide) {
            maxIndex = Math.ceil(items.length / itemsPerSlide) - 1;
            currentIndex = Math.min(currentIndex, maxIndex);
            // Update item widths for new layout
            items.forEach(item => {
                item.style.flex = `0 0 ${100 / itemsPerSlide}%`;
            });
            createIndicators();
            updateCarousel();
            resetAutoAdvance();
        }
    });
    
    // Set initial item widths
    items.forEach(item => {
        item.style.flex = `0 0 ${100 / itemsPerSlide}%`;
    });
    
    // Next button: go to next slide
    nextButton.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % (maxIndex + 1);
        updateCarousel();
        resetAutoAdvance();
    });
    
    // Previous button: go to previous slide
    prevButton.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + maxIndex + 1) % (maxIndex + 1);
        updateCarousel();
        resetAutoAdvance();
    });
    
    // Pause auto-advance on mouse enter, resume on mouse leave
    const carouselContainer = document.querySelector('.carousel-container');
    carouselContainer.addEventListener('mouseenter', function() {
        if (autoAdvance) {
            clearInterval(autoAdvance);
            autoAdvance = null;
        }
    });
    carouselContainer.addEventListener('mouseleave', function() {
        if (!isDragging) {
            resetAutoAdvance();
        }
    });
    
    // Touch and mouse drag/swipe support
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
        if (autoAdvance) {
            clearInterval(autoAdvance);
            autoAdvance = null;
        }
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
            const container = document.querySelector('.carousel-container');
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
            if (!carouselContainer.matches(':hover')) {
                resetAutoAdvance();
            }
        }
    }
    // Get X position from mouse or touch event
    function getPositionX(event) {
        return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
    }
    // Animation loop for smooth dragging
    function animation() {
        if (isDragging) {
            const slideWidth = 100 / itemsPerSlide;
            const maxTranslate = slideWidth * itemsPerSlide * maxIndex;
            // Set limits for dragging based on current index
            let minTranslate = -slideWidth * itemsPerSlide;
            let maxAllowedTranslate = slideWidth * itemsPerSlide;
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
            const baseTranslate = -(currentIndex * slideWidth * itemsPerSlide);
            track.style.transform = `translateX(${baseTranslate + currentTranslate}%)`;
            requestAnimationFrame(animation);
        }
    }
    // Initialize carousel on page load
    maxIndex = Math.ceil(items.length / itemsPerSlide) - 1;
    createIndicators();
    updateCarousel();
    resetAutoAdvance();
});