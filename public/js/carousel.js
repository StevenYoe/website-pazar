document.addEventListener('DOMContentLoaded', function() {
    const track = document.getElementById('certificationTrack');
    const items = document.querySelectorAll('.certification-item');
    const nextButton = document.querySelector('.carousel-next');
    const prevButton = document.querySelector('.carousel-prev');
    const indicatorsContainer = document.querySelector('.carousel-indicators');
    
    let currentIndex = 0;
    let itemsPerSlide = window.innerWidth >= 793 ? 2 : 1;
    let maxIndex = Math.ceil(items.length / itemsPerSlide) - 1;
    let autoAdvance = null;
    
    // Touch/swipe variables
    let isDragging = false;
    let startPos = 0;
    let currentTranslate = 0;
    let prevTranslate = 0;
    let animationID = 0;
    
    // Set cursor style
    track.style.cursor = 'grab';
    
    function createIndicators() {
        indicatorsContainer.innerHTML = '';
        
        for (let i = 0; i <= maxIndex; i++) {
            const button = document.createElement('button');
            button.classList.add('h-2', 'w-2', 'rounded-full', 'mx-1');
            
            if (i === currentIndex) {
                button.classList.add('bg-custom-green');
            } else {
                button.classList.add('bg-gray-300');
            }
            
            button.addEventListener('click', function() {
                currentIndex = i;
                updateCarousel();
                resetAutoAdvance();
            });
            
            indicatorsContainer.appendChild(button);
        }
    }
    
    function updateCarousel() {
        const itemWidth = 100 / itemsPerSlide;
        const offset = currentIndex * itemWidth * itemsPerSlide;
        track.style.transform = `translateX(-${offset}%)`;
        
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
    
    function resetAutoAdvance() {
        if (autoAdvance) {
            clearInterval(autoAdvance);
        }
        
        autoAdvance = setInterval(function() {
            currentIndex = (currentIndex + 1) % (maxIndex + 1);
            updateCarousel();
        }, 5000);
    }
    
    window.addEventListener('resize', function() {
        const oldItemsPerSlide = itemsPerSlide;
        itemsPerSlide = window.innerWidth >= 793 ? 2 : 1;
        
        if (oldItemsPerSlide !== itemsPerSlide) {
            maxIndex = Math.ceil(items.length / itemsPerSlide) - 1;
            currentIndex = Math.min(currentIndex, maxIndex);
            
            // Reset item widths
            items.forEach(item => {
                item.style.flex = `0 0 ${100 / itemsPerSlide}%`;
            });
            
            createIndicators();
            updateCarousel();
            resetAutoAdvance();
        }
    });
    
    // Set up item widths
    items.forEach(item => {
        item.style.flex = `0 0 ${100 / itemsPerSlide}%`;
    });
    
    nextButton.addEventListener('click', function() {
        currentIndex = (currentIndex + 1) % (maxIndex + 1);
        updateCarousel();
        resetAutoAdvance();
    });
    
    prevButton.addEventListener('click', function() {
        currentIndex = (currentIndex - 1 + maxIndex + 1) % (maxIndex + 1);
        updateCarousel();
        resetAutoAdvance();
    });
    
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
    
    track.addEventListener('touchstart', touchStart);
    track.addEventListener('touchmove', touchMove);
    track.addEventListener('touchend', touchEnd);
    
    track.addEventListener('mousedown', touchStart);
    window.addEventListener('mousemove', touchMove);
    window.addEventListener('mouseup', touchEnd);
    
    track.addEventListener('contextmenu', e => {
        e.preventDefault();
        e.stopPropagation();
    });
    
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
    
    function touchMove(event) {
        if (isDragging) {
            const currentPosition = getPositionX(event);
            currentTranslate = prevTranslate + currentPosition - startPos;
            
            if (event.type === 'mousemove') {
                event.preventDefault();
            }
        }
    }
    
    function touchEnd() {
        cancelAnimationFrame(animationID);
        
        if (isDragging) {
            track.style.cursor = 'grab';
            
            const threshold = 15;
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
    
    function getPositionX(event) {
        return event.type.includes('mouse') ? event.pageX : event.touches[0].clientX;
    }
    
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
    
    maxIndex = Math.ceil(items.length / itemsPerSlide) - 1;
    createIndicators();
    updateCarousel();
    resetAutoAdvance();
});