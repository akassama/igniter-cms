document.addEventListener("DOMContentLoaded", function () {
    //existing code
    // Navbar scroll effect
    const navbar = document.querySelector(".navbar");
    window.addEventListener("scroll", function () {
        if (window.scrollY > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
    // Initialize scroll spy
    const scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: "#navbar",
        offset: 100,
    });
    // Scroll to Top Button
    const scrollToTopBtn = document.getElementById("scrollToTop");
    window.addEventListener("scroll", function () {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.add("active");
        } else {
            scrollToTopBtn.classList.remove("active");
        }
    });
    scrollToTopBtn.addEventListener("click", function (e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        });
    });
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const targetId = this.getAttribute("href");
            if (targetId === "#") return;
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const offset = 90; // Adjust for fixed navbar height
                const targetPosition =
                    targetElement.getBoundingClientRect().top +
                    window.pageYOffset -
                    offset;
                window.scrollTo({
                    top: targetPosition,
                    behavior: "smooth",
                });
                // Close mobile menu when clicking a link
                const navbarCollapse = document.querySelector(".navbar-collapse");
                if (navbarCollapse.classList.contains("show")) {
                    new bootstrap.Collapse(navbarCollapse).hide();
                }
            }
        });
    });
    // Highlight current section in navigation
    const sections = document.querySelectorAll("section");
    const navItems = document.querySelectorAll(".nav-link");
    window.addEventListener("scroll", function () {
        let current = "";
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (pageYOffset >= sectionTop - 100) {
                current = section.getAttribute("id");
            }
        });
        navItems.forEach((item) => {
            item.classList.remove("active");
            if (item.getAttribute("href") === `#${current}`) {
                item.classList.add("active");
            }
        });
    });
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    // Initialize popovers
    const popoverTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="popover"]')
    );
    const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // New code for additional sections
    // Initialize Glightbox
    GLightbox({
        selector: ".glightbox",
    });

    // Initialize Swiper for testimonials
    const testimonialsSwiper = new Swiper(".testimonials-slider", {
        speed: 600,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        slidesPerView: "auto",
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1200: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
        },
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const countsSection = document.getElementById("counts");

    function animateCount(element) {
        const target = parseInt(element.getAttribute("data-count"), 10);
        const duration = 2000; // 2 seconds
        let startTimestamp = null;

        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = timestamp - startTimestamp;
            const currentCount = Math.min(
                target,
                Math.floor((progress / duration) * target)
            );
            element.innerText = currentCount.toLocaleString();

            if (progress < duration) {
                window.requestAnimationFrame(step);
            }
        };

        window.requestAnimationFrame(step);
    }

    const observerOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 0.5,
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const counters = entry.target.querySelectorAll(".counter");
                counters.forEach((counter) => {
                    animateCount(counter);
                });
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    if (countsSection) {
        observer.observe(countsSection);
    }
});

//preloader
window.addEventListener("load", function () {
    document.body.classList.add("loaded");

    // Remove preloader from DOM after fade out completes
    setTimeout(function () {
        const preloader = document.getElementById("preloader");
        if (preloader) {
            preloader.remove();
        }
    }, 500); // Match this with the transition time
});
