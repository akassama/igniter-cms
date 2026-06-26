/**
 * Preloader
 */
const preloader = document.querySelector("#preloader");
if (preloader) {
    window.addEventListener("load", () => {
        preloader.classList.add("loaded");
        setTimeout(() => {
            preloader.remove();
        }, 1000);
    });
}

/**
 * Navbar links active state on scroll
 */
let navbarlinks = document.querySelectorAll("#navbar .scrollto");
function navbarlinksActive() {
    navbarlinks.forEach((navbarlink) => {
        if (!navbarlink.hash) return;
        let section = document.querySelector(navbarlink.hash);
        if (!section) return;
        let position = window.scrollY + 200;
        if (
            position >= section.offsetTop &&
            position <= section.offsetTop + section.offsetHeight
        ) {
            navbarlink.classList.add("active");
        } else {
            navbarlink.classList.remove("active");
        }
    });
}
window.addEventListener("load", navbarlinksActive);
document.addEventListener("scroll", navbarlinksActive);

/**
 * Scroll top button
 */
const scrollTop = document.querySelector(".scroll-top");
if (scrollTop) {
    const toggleScrollTop = () => {
        if (window.scrollY > 100) {
            scrollTop.classList.add("active");
        } else {
            scrollTop.classList.remove("active");
        }
    };
    window.addEventListener("load", toggleScrollTop);
    document.addEventListener("scroll", toggleScrollTop);
    scrollTop.addEventListener(
        "click",
        window.scrollTo({
            top: 0,
            behavior: "smooth",
        })
    );
}

/**
 * GLightbox
 */
const glightbox = GLightbox({
    selector: ".glightbox",
});

/**
 * Initiate Swiper in Testimonials
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
        1200: {
            slidesPerView: 3,
            spaceBetween: 20,
        },
    },
});

/**
 * Update current year in footer
 */
document.getElementById("current-year").textContent = new Date().getFullYear();
