/*!
* Start Bootstrap - Modern Business v5.0.7 (https://startbootstrap.com/template-overviews/modern-business)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-modern-business/blob/master/LICENSE)
*/
// This file is intentionally blank
// Use this file to add JavaScript to your project
document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation Function
    function animateCounter() {
        const counterElements = document.querySelectorAll('.counter-number');

        counterElements.forEach(element => {
            const target = parseInt(element.getAttribute('data-target'));
            const duration = 2000; // Total animation time in milliseconds
            const interval = 50; // Update interval
            let current = 0;

            const updateCounter = () => {
                // Calculate increment based on duration and interval
                const increment = target / (duration / interval);

                if (current < target) {
                    current += increment;
                    // Ensure we don't overshoot the target
                    element.textContent = Math.min(Math.round(current), target);

                    setTimeout(updateCounter, interval);
                }
            };

            // Use Intersection Observer to start animation when in view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        updateCounter();
                        observer.unobserve(element);
                    }
                });
            }, { threshold: 0.1 });

            observer.observe(element);
        });
    }

    // Initialize counter animation
    animateCounter();
});