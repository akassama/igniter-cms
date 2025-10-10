/**
 * Site JavaScript
 */
document.addEventListener("DOMContentLoaded", () => {
    /**
     * Preloader
     */
    const preloader = document.getElementById("preloader");
    if (preloader) {
        window.addEventListener("load", () => {
            setTimeout(() => {
                preloader.classList.add("hide");
            }, 100);
        });
    }

    /**
     * Header Scroll Effect
     */
    const header = document.getElementById("header");
    if (header) {
        const headerScrolled = () => {
            if (window.scrollY > 100) {
                header.classList.add("scrolled");
            } else {
                header.classList.remove("scrolled");
            }
        };
        window.addEventListener("load", headerScrolled);
        document.addEventListener("scroll", headerScrolled);
    }

    /**
     * Testimonials Slider
     */
    new Swiper(".testimonials-slider", {
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

    /**
     * Scroll Top Button
     */
    const scrollTop = document.getElementById("scroll-top");
    if (scrollTop) {
        const toggleScrollTop = () => {
            if (window.scrollY > 100) {
                scrollTop.classList.add("show");
            } else {
                scrollTop.classList.remove("show");
            }
        };
        window.addEventListener("load", toggleScrollTop);
        document.addEventListener("scroll", toggleScrollTop);
        scrollTop.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth",
            });
        });
    }
});